<?php

namespace DrDoh\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Doctrine\ORM\EntityManagerInterface;

use DrDoh\TicketBundle\Entity\Ticket;
use DrDoh\TicketBundle\Entity\Guest;
use DrDoh\TicketBundle\Entity\Buyer;

use DrDoh\TicketBundle\Form\BuyerType;

use DrDoh\TicketBundle\Services\DrDohPriceCal;
use DrDoh\TicketBundle\Services\DrDohSendTickets;
use DrDoh\TicketBundle\Services\DrDohStripe;
use DrDoh\TicketBundle\Services\DrDohTicketStatus;


class BookingController extends Controller
{
/* -------- \\\\\ Action -=> ticketForm : Controle la premiere page de formulaire /////-------- */
    public function ticketFormAction(Request $request, SessionInterface $session, DrDohTicketStatus $DrDohTicketStatus)
    {       
        // --------vvvvv Datas vvvvv-------
        $repo = $this->getDoctrine()->getManager()->getRepository('DrDohTicketBundle:Ticket');
        $tickets = $repo->TicketsAfterNow();
        $fullDateArray = $DrDohTicketStatus->getFullDate($tickets);

        // --------vvvvv Logic vvvvv-------
        if ($request->isMethod('POST')){
            // -------- Set Session -------              
            $session->clear();
            $session->set('userChoices', $request->request->all());
            // -------- Check Dispo -------
            if($DrDohTicketStatus->checkDispo($tickets, $session->get('userChoices')) == true){
                return $this->redirectToRoute('dr_doh_ticket_billetterie_2');
            }else{
                $this->addFlash(
                    'notice',
                    'Nous n\'avons plus de places disponible pour cette date'
                );
            }
        }
        return $this->render('DrDohTicketBundle:Default:ticketForm.html.twig', array(
            'listFullDate' => $fullDateArray
        ));
    }

/* -------- \\\\\ Action -=> guestForm : Controle la seconde page de formulaire /////-------- */
    public function guestFormAction(Request $request, SessionInterface $session, DrDohTicketStatus $DrDohTicketStatus)
    {
        // --------vvvvv Datas form Repo vvvvv-------
        $repo = $this->getDoctrine()->getManager()->getRepository('DrDohTicketBundle:Ticket');
        $tickets = $repo->TicketsAfterNow();

        // --------vvvvv Logic vvvvv-------
        $buyer = new Buyer();
        $buyerForm = $this->get('form.factory')->create(BuyerType::class, $buyer);

        if ($request->isMethod('POST') && $buyerForm->handleRequest($request)->isValid()){
            
            $dispo = $DrDohTicketStatus->checkDispo($tickets, $session->get('userChoices'));
            
            if($dispo == true){
                $session->set('buyer',$buyerForm->getData());
                return $this->redirectToRoute('dr_doh_ticket_billetterie_stipe');
            }else{
                return $this->redirectToRoute('dr_doh_ticket_billetterie');
            }
        }
            return $this->render('DrDohTicketBundle:Default:guestForm.html.twig', array(
            'form' => $buyerForm->createView(), 
        ));
    }

/* -------- \\\\\ Action -=> stripeForm : Controle la page de payement /////-------- */
    public function stripeFormAction(Request $request, SessionInterface $session, DrDohPriceCal $DrDohPriceCal, DrDohStripe $DrDohStripe)
    {
        // --------vvvvv Datas form Services vvvvv-------
        $DrDohPriceCal->setPrices($session); 

        // --------vvvvv Logic vvvvv-------
        return $this->render('DrDohTicketBundle:Default:stripeForm.html.twig'
        , array(
            'publishable_key' => $DrDohStripe->getPublishableKey(),
        ));   
    }

/* -------- \\\\\ Action -=> stripeCharge : Valide le payement /////-------- */
    public function stripeCheckoutAction(Request $request, SessionInterface $session, DrDohStripe $DrDohStripe, DrDohTicketStatus $DrDohTicketStatus, EntityManagerInterface $em)
    {     
        // --------vvvvv Datas vvvvv-------
        $repo = $this->getDoctrine()->getManager()->getRepository('DrDohTicketBundle:Ticket');
        $tickets = $repo->TicketsAfterNow();
        $customer = $DrDohStripe->getCustomer($request->request->get('email'), $request->request->get('token'));
        $invoiceAmount = $session->get('buyer')->getAmountPaid();
        $session->get('buyer')->setEmail($request->request->get('email'));
        
        // --------vvvvv Logic vvvvv-------
        if ($request->isMethod('POST')){
            $dispo = $DrDohTicketStatus->checkDispo($tickets, $session->get('userChoices'));
            if($dispo == true){
                try {
                    $charge = $DrDohStripe->getCharge($customer,$invoiceAmount);
                    $orderId = $session->get('buyer')->getOrderId();
                    $em->persist($session->get('buyer'));
                    $em->flush();
                    return $this->redirectToRoute("dr_doh_ticket_billetterie_sending_ticket", ['orderId'=> $orderId]);
                } catch(\Stripe\Error\Card $e) {
                    return $this->redirectToRoute("dr_doh_ticket_billetterie_2");
                }
            }else{
                return $this->redirectToRoute('dr_doh_ticket_billetterie');
            }
        }      
        
    }

/* -------- \\\\\ Action -=> sendingTicket : Envoye le billet et redirige sur la page d'accueil /////-------- */
    public function sendingTicketAction($orderId, Request $request, DrDohSendTickets $DrDohSendTickets, EntityManagerInterface $em, SessionInterface $session)
    {
        // --------vvvvv Repo vvvvv-------
        $buyerRepo = $em->getRepository('DrDohTicketBundle:Buyer');
        $buyer = $buyerRepo->findByOrderId($orderId);
        
        $ticketRepo = $this->getDoctrine()->getManager()->getRepository('DrDohTicketBundle:Ticket');
        $listTickets = $ticketRepo->findBy(array('buyer'=>$buyer[0]));
        // --------vvvvv Logic vvvvv------- 
        $DrDohSendTickets->sendTickets($buyer[0], $listTickets);
        $session->clear();
        return $this->render("DrDohTicketBundle:Default:thx.html.twig");
    }

}