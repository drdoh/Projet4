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
        
        $qteMax = $this->container->getParameter('ticketverification_qteMax');

        $fullDateArray = $tiketsVerfification->getFullDate($dateTikets, $qteMax);
        
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
