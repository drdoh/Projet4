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
        $fullDateArray = $ticketsVerfification->getFullDate($tickets, $qteMax);

    /* -------- \\\\\ Appelle de la vue avec parametres /////-------- */     
        return $this->render('DrDohTicketBundle:Default:ticketForm.html.twig', array(
            'listFullDate' => $fullDateArray
        ));
    }

/* -------- \\\\\ Action -=> guestForm : Controle la seconde page de formulaire /////-------- */
    public function guestFormAction(Request $request)
    {
    /* -------- \\\\\$_POST = ticket_qte, choix, date /////-------- */ 
    /* -------- \\\\\Creation d'un formulaire pour l'acheteur /////-------- */     
/*   $buyer = new Buyer();
        $uniqueId =  sha1(uniqid('',true));
        $buyer->setOrderId($uniqueId);
        $buyer->setOrderDate(new \DateTime);
        $buyer->setAmountPaid(159);
        
        $ticket = new Ticket();
        $ticket->setTicketId($uniqueId);
        $ticket->setDate(new \DateTime);
        $buyer->setTicket($ticket);
        $mainForm = $this->get('form.factory')->create(BuyerType::class, $buyer);
        var_dump($buyer);
*/
        $guest = new Guest();
        $uniqueId =  sha1(uniqid('',true));
        
        $ticket = new Ticket();
        $ticket->setTicketId($uniqueId);
        $ticket->setDate(new \DateTime);
        $guest->setTicket($ticket);
        $mainForm = $this->get('form.factory')->create(GuestType::class, $guest);
        var_dump($guest);
           
        
    /* -------- \\\\\Validation du formulaire /////-------- */
    if ($request->isMethod('POST') && $mainForm->handleRequest($request)->isValid()){
        $em = $this->getDoctrine()->getManager();
        $em->persist($guest);
        $em->flush();
    }
    
    
    return $this->render('DrDohTicketBundle:Default:guestForm.html.twig', array(
        'main_form' => $mainForm->createView(),
    )); 
    }

}
