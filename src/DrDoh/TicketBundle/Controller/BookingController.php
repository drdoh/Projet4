<?php

namespace DrDoh\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DrDoh\TicketBundle\Entity\Ticket;
use DrDoh\TicketBundle\Form\TicketType;
use DrDoh\TicketBundle\Entity\Guest;
use DrDoh\TicketBundle\Entity\Buyer;
use DrDoh\TicketBundle\Form\GuestType;
use DrDoh\TicketBundle\Form\BuyerType;
use Symfony\Component\Validator\Constraints\DateTime;

class BookingController extends Controller
{
/* -------- \\\\\ Action -=> ticketForm : Controle la premiere page de formulaire /////-------- */
    public function ticketFormAction()
    {  
    /* -------- \\\\\ Creation des repositories /////-------- */
        
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('DrDohTicketBundle:Ticket');

    /* -------- \\\\\ Recuperation des services /////-------- */ 

        $ticketsVerfification = $this->container->get('dr_doh_ticket.ticket_verification');

    /* -------- \\\\\ Utilisation des services /////-------- */ 

        $tickets = $repository->findAll();
        $qteMax = $this->container->getParameter('ticketverification_qteMax');
        $yearMax = $this->container->getParameter('ticketverification_yearMax');
        $fullDateArray = $ticketsVerfification->getFullDate($tickets, $qteMax, $yearMax);

    /* -------- \\\\\ Appelle de la vue avec parametres /////-------- */     
        return $this->render('DrDohTicketBundle:Default:ticketForm.html.twig', array(
            'listFullDate' => $fullDateArray
        ));
    }

/* -------- \\\\\ Action -=> guestForm : Controle la seconde page de formulaire /////-------- */
    public function guestFormAction(Request $request)
    {
        /* -------- \\\\\$_POST = ticket_qte, choix, date /////-------- */ 

        if(isset($_POST['ticket_qte'])&& isset($_POST['choix'])&& isset($_POST['date'])){
            $ticket_qte = intval($_POST['ticket_qte']);
            $choix = $_POST['choix'];
            $date = $_POST['date'];
            $date = \DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            $date = new \DateTime($date);
        }else{
            $ticket_qte = count($_POST);
            $choix = 'journee'; // COMMENT REUCPERER CETTE VARIABLE ...
            $date = '01/02/1900'; // COMMENT REUCPERER CETTE VARIABLE ...
            $date = \DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            $date = new \DateTime($date);
        }
        
        $buyer = new Buyer();
        $buyer->setAmountPaid(159);
        $ticket = new Ticket();
        $ticket->setDate($date);
        $buyer->setTicket($ticket);

        $buyerForm = $this->get('form.factory')->create(BuyerType::class, $buyer);

        if ($request->isMethod('POST') && $buyerForm->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($buyer);
            $em->flush();
            return $this->redirectToRoute('dr_doh_ticket_billetterie_stipe');
        }

        return $this->render('DrDohTicketBundle:Default:guestForm.html.twig', array(
            'form' => $buyerForm->createView(), 
            'ticket_qte' => $ticket_qte,
        ));
     }

    public function stripeFormAction(Request $request)
    {
        return $this->render('DrDohTicketBundle:Default:stripeForm.html.twig');   
    }

}
