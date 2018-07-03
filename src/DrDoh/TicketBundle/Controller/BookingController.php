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
    public function ticketFormAction()
    {       
        $repo = $this->getDoctrine()->getManager()->getRepository('DrDohTicketBundle:Ticket');
        $tickets = $repo->findAll();
        
        $ticketsVerfification = $this->container->get('dr_doh_services.tickets_status');
        $fullDateArray = $ticketsVerfification->getFullDate($tickets);

        return $this->render('DrDohTicketBundle:Default:ticketForm.html.twig', array(
            'listFullDate' => $fullDateArray
        ));
    }

/* -------- \\\\\ Action -=> guestForm : Controle la seconde page de formulaire /////-------- */
    public function guestFormAction(Request $request)
    {
        $session = $request->getSession(); 
        if($request->request->get('date') != null){
            $session->set('date', $request->request->get('date'));
            $session->set('choix', $request->request->get('choix'));
            $session->set('ticket_qte', $request->request->get('ticket_qte'));
        }
        
        $date = $session->get('date');
        $date = \DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        $date = new \DateTime($date);

        $buyer = new Buyer();
        $buyerForm = $this->get('form.factory')->create(BuyerType::class, $buyer);

        if ($request->isMethod('POST') && $buyerForm->handleRequest($request)->isValid()){
            $formDatas = $buyerForm->getData("formDatas");
            $em = $this->getDoctrine()->getManager();
            $entitiesSetter = $this->container->get('dr_doh_services.set_entities');
            $entitiesSetter->setEntities($formDatas, $date, $em);
            return $this->stripeFormAction($formDatas, $date);
        }
        
        return $this->render('DrDohTicketBundle:Default:guestForm.html.twig', array(
            'form' => $buyerForm->createView(), 
            'ticket_qte' => $session->get('ticket_qte'),
        ));
    }
    
/* -------- \\\\\ Action -=> stripeForm : Controle la page de payement /////-------- */
    public function stripeFormAction($formDatas, $date)
    {
        $stripe = $this->container->get('dr_doh_services.stripe');


        var_dump($formDatas);
        return $this->render('DrDohTicketBundle:Default:stripeForm.html.twig', array(
            'formDatas' => $formDatas,
            'publishable_key' => $stripe->getPublishableKey(),
        ));   
    }
/* -------- \\\\\ Action -=> stripeCharge : Valide le payement /////-------- */
    public function stripeChargeAction()
    {
        $stripe = $this->container->get('dr_doh_services.stripe');
        $token  = $_POST['stripeToken'];
        $email  = $_POST['stripeEmail'];
        $invoiceAmount = 5000;
        $customer = $stripe->getCustomer($email,$token);
        $charge = $stripe->getCharge($customer,$invoiceAmount);
        
        var_dump($charge->paid);
        exit;
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        echo '<h1>Successfully charged '.$invoiceAmount.'</h1>';
        $url = $this->get('router')->generate('dr_doh_ticket_billetterie');
        return new RedirectResponse($url);
    }
}