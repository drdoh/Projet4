<?php

namespace DrDoh\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DrDoh\TicketBundle\Entity\Ticket;
use DrDoh\TicketBundle\Form\TicketType;
use DrDoh\TicketBundle\Entity\Guest;
use DrDoh\TicketBundle\Form\GuestType;

class BookingController extends Controller
{
    public function ticketFormAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('DrDohTicketBundle:Ticket');
        
        $dateTikets = $repository->findAll();
        
        $tiketsVerfification = $this->container->get('dr_doh_ticket.ticket_verification');
     
        $fullDate = $tiketsVerfification->getFullDate($dateTikets);

        //var_dump($fullDate);
        
        return $this->render('DrDohTicketBundle:Default:ticketForm.html.twig');
    }

    public function guestFormAction()
    {
        
        //var_dump($_POST);
        
        $guest = new Guest();
        
        $form = $this->get('form.factory')->create(GuestType::class, $guest);
        
        return $this->render('DrDohTicketBundle:Default:guestForm.html.twig', array(
            'form' => $form->createView(),
        )); 
    }

}
