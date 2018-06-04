<?php

namespace DrDoh\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DrDoh\TicketBundle\Entity\Ticket;
use DrDoh\TicketBundle\Form\TicketType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $ticket = new Ticket();
        $form = $this->get('form.factory')->create(TicketType::class, $ticket);
        return $this->render('DrDohTicketBundle:Default:index.html.twig',array(
            'form' => $form->createView(),
        ));
    }

}
