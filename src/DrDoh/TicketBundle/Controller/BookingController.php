<?php

namespace DrDoh\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use DrDoh\TicketBundle\Entity\Ticket;
use DrDoh\TicketBundle\Entity\Guest;
use DrDoh\TicketBundle\Entity\Buyer;
use DrDoh\TicketBundle\Form\BuyerType;
use Symfony\Component\Validator\Constraints\DateTime;

class BookingController extends Controller
{
/* -------- \\\\\ Action -=> ticketForm : Controle la premiere page de formulaire /////-------- */
    public function ticketFormAction(Request $request)
    {       
        // --------vvvvv Datas form Repo vvvvv-------
        $repo = $this->getDoctrine()->getManager()->getRepository('DrDohTicketBundle:Ticket');
        $tickets = $repo->TicketsAfterNow();

        // --------vvvvv Services vvvvv-------
        $ticketsChecker = $this->container->get('dr_doh_services.tickets_status');
        $fullDateArray = $ticketsChecker->getFullDate($tickets);
        // --------vvvvv Logic vvvvv-------
        if ($request->isMethod('POST')){

            // -------- Set Session -------              
            $session = $request->getSession();
            $session->set('date', $request->request->get('date'));
            $session->set('choix', $request->request->get('choix'));
            $session->set('ticket_qte', $request->request->get('ticket_qte'));

            $dispo = $ticketsChecker->checkDispo($tickets, $session->get('date'), $session->get('ticket_qte'));
            
            if($dispo == true){
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
    public function guestFormAction(Request $request)
    {
        // --------vvvvv Datas from Session vvvvv-------
        $session = $request->getSession(); 
        $date = $session->get('date');
        $ticketQte = $session->get('ticket_qte');

        // --------vvvvv Services vvvvv-------
        $ticketsChecker = $this->container->get('dr_doh_services.tickets_status');
        
        // --------vvvvv Datas form Repo vvvvv-------
        $repo = $this->getDoctrine()->getManager()->getRepository('DrDohTicketBundle:Ticket');
        $tickets = $repo->TicketsAfterNow();

        // --------vvvvv Logic vvvvv-------
        $buyer = new Buyer();
        $buyerForm = $this->get('form.factory')->create(BuyerType::class, $buyer);

        if ($request->isMethod('POST') && $buyerForm->handleRequest($request)->isValid()){
            
            $dispo = $ticketsChecker->checkDispo($tickets, $date, $ticketQte);
            
            if($dispo == true){
                $buyer = $buyerForm->getData();
                $session->set('buyer',$buyer);
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
    public function stripeFormAction(Request $request)
    {
        // --------vvvvv Services vvvvv-------
        $stripeService = $this->container->get('dr_doh_services.stripe');
        $priceCalService = $this->container->get('dr_doh_services.price_cal');

        // --------vvvvv Datas from Session vvvvv-------
        $session = $request->getSession(); 
        $buyer = $session->get('buyer');
        $date = $session->get('date');

        // --------vvvvv Datas form Services vvvvv-------
        $priceCalService->setPrices($buyer, $date); 

        // --------vvvvv Logic vvvvv-------
        return $this->render('DrDohTicketBundle:Default:stripeForm.html.twig'
        , array(
            'publishable_key' => $stripeService->getPublishableKey(),
        ));   
    }
/* -------- \\\\\ Action -=> stripeCharge : Valide le payement /////-------- */
    public function stripeCheckoutAction(Request $request)
    {     
        // --------vvvvv Services vvvvv-------
        $stripeService = $this->container->get('dr_doh_services.stripe');
        // $entitiesSetter = $this->container->get('dr_doh_services.set_entities');
        $ticketsChecker = $this->container->get('dr_doh_services.tickets_status');

        // --------vvvvv Datas from Session vvvvv-------
        $session = $request->getSession();
        $buyer = $session->get('buyer');
        $date = $session->get('date');

        // --------vvvvv Datas form Repo vvvvv-------
        $repo = $this->getDoctrine()->getManager()->getRepository('DrDohTicketBundle:Ticket');
        $tickets = $repo->TicketsAfterNow();
        
        // --------vvvvv Datas form Post vvvvv-------
        $token  = $request->request->get('token');
        $email  = $request->request->get('email');
        
        // --------vvvvv Datas form Services vvvvv-------
        $customer = $stripeService->getCustomer($email, $token);
        $invoiceAmount = $buyer->getAmountPaid();

        // --------vvvvv Entities Manager vvvvv-------
        $em = $this->getDoctrine()->getManager();
        
        // --------vvvvv Logic vvvvv-------
        if ($request->isMethod('POST')){
            $dispo = $ticketsChecker->checkDispo($tickets, $session->get('date'), $session->get('ticket_qte'));
            
            if($dispo == true){
                try {
                    $charge = $stripeService->getCharge($customer,$invoiceAmount);
                    $orderId = $buyer->getOrderId();
                
                    $em->persist($buyer);
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
    public function sendingTicketAction($orderId, Request $request)
    {
        // --------vvvvv Services vvvvv-------
        $sendTickets = $this->container->get('dr_doh_services.sendTickets');
        
        // --------vvvvv Repo vvvvv-------
        $em = $this->getDoctrine()->getManager();
        $buyerRepo = $em->getRepository('DrDohTicketBundle:Buyer');
        $ticketRepo = $this->getDoctrine()->getManager()->getRepository('DrDohTicketBundle:Ticket');
        
        // --------vvvvv Datas form Repo vvvvv-------
        $buyer = $buyerRepo->findByOrderId($orderId);
        
        
        $listTickets = $ticketRepo->findBy(array('buyer'=>$buyer[0]));
        
        // --------vvvvv Logic vvvvv------- 
        $sendTickets->sendTickets($buyer, $listTickets);
        
        return $this->redirectToRoute("dr_doh_ticket_billetterie_thx");
    }

    public function thxAction()
    {
        return $this->render("DrDohTicketBundle:Default:thx.html.twig");
    }

}