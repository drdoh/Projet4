<?php

namespace DrDoh\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DrDoh\TicketBundle\Entity\Ticket;
use DrDoh\TicketBundle\Form\TicketType;
use DrDoh\TicketBundle\Entity\Guest;
use DrDoh\TicketBundle\Form\GuestType;
use Symfony\Component\Validator\Constraints\DateTime;

class BookingController extends Controller
{
    public function ticketFormAction()
    {

        // $repo=$this->getDoctrine()->getManager()->getRepository('DrDohTicketBundle:Ticket');
        // $tickets = $repo->findAll();
        // $ticketsArray = [];
        // foreach($tickets as $ticket){
        //     $ticketDate = $ticket->getDate()->format('Y-m-d');
            
        //     if(array_key_exists($ticketDate,$ticketsArray)){
                
        //         $ticketsArray[$ticketDate] ++;
        //     }else{
        //         $ticketsArray[$ticketDate] = 1 ;
        //     }

        //     var_dump($ticketsArray);
        // }


        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('DrDohTicketBundle:Ticket');
        
        $tickets = $repository->findAll();
        
        $ticketsVerfification = $this->container->get('dr_doh_ticket.ticket_verification');
        
        $qteMax = $this->container->getParameter('ticketverification_qteMax');

        $fullDateArray = $ticketsVerfification->getFullDate($tickets, $qteMax);
        
        return $this->render('DrDohTicketBundle:Default:ticketForm.html.twig', array(
            'listFullDate' => $fullDateArray
        ));
    }

    public function guestFormAction(Request $request)
    {
        
        $guest = new Guest();
        
        $form = $this->get('form.factory')->create(GuestType::class, $guest);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            var_dump($guest);
        }

        
        return $this->render('DrDohTicketBundle:Default:guestForm.html.twig', array(
            'form' => $form->createView(),

        )); 
    }

}
