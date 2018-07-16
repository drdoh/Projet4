<?php

namespace DrDoh\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use DrDoh\TicketBundle\Entity\Ticket;
use DrDoh\TicketBundle\Entity\Guest;
use DrDoh\TicketBundle\Entity\Buyer;
use DrDoh\TicketBundle\Form\TicketType;
use Symfony\Component\Validator\Constraints\DateTime;
use Dompdf\Options;
use Dompdf\Dompdf;

class BookingController extends Controller
{
/* -------- \\\\\ Action -=> ticketForm : Controle la premiere page de formulaire /////-------- */
    public function ticketFormAction(Request $request)
    {       
        $repo = $this->getDoctrine()->getManager()->getRepository('DrDohTicketBundle:Ticket');
        $tickets = $repo->findAll();
        
        $ticketsVerfification = $this->container->get('dr_doh_services.tickets_status');
        $fullDateArray = $ticketsVerfification->getFullDate($tickets);

        if ($request->isMethod('POST')){

            $session = $request->getSession();
            $date =$request->request->get('date');
            $date = \DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            $date = new \DateTime($date);
            $session->set('date', $date);
            $session->set('choix', $request->request->get('choix'));
            $session->set('ticket_qte', $request->request->get('ticket_qte'));

            $dispo = $ticketsVerfification->checkDispo($tickets, $_POST['date'], $_POST['ticket_qte']);

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

        // --------vvvvv Logic vvvvv-------
        $ticket = new Ticket();
        $ticketForm = $this->get('form.factory')->create(TicketType::class, $ticket);

        if ($request->isMethod('POST') && $ticketForm->handleRequest($request)->isValid()){

            $formDatas = $ticketForm->getData();
            $session->set('form_datas',$formDatas);

            return $this->redirectToRoute('dr_doh_ticket_billetterie_stipe');
        }
        
        return $this->render('DrDohTicketBundle:Default:guestForm.html.twig', array(
            'form' => $ticketForm->createView(), 
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
        $formDatas = $session->get('form_datas');
        $date = $session->get('date');
        // --------vvvvv Datas form Services vvvvv-------
        $prices = $priceCalService->getPrices($formDatas, $date);
        $invoiceAmount = $priceCalService->getTotalPrice($formDatas, $date); 
        $PriceType = $priceCalService->getPriceTypeArray($formDatas, $date);

        // --------vvvvv Logic vvvvv-------
        return $this->render('DrDohTicketBundle:Default:stripeForm.html.twig'
        , array(
            'publishable_key' => $stripeService->getPublishableKey(),
            'invoice_amount'=> $invoiceAmount,
            'price_type'=>  $PriceType,
            'prices'=> $prices,
        ));   
    }
/* -------- \\\\\ Action -=> stripeCharge : Valide le payement /////-------- */
    public function stripeCheckoutAction(Request $request)
    {
        // --------vvvvv Services vvvvv-------
        $stripeService = $this->container->get('dr_doh_services.stripe');
        $entitiesSetter = $this->container->get('dr_doh_services.set_entities');
        $priceCalService = $this->container->get('dr_doh_services.price_cal');
        // --------vvvvv Datas from Session vvvvv-------
        $session = $request->getSession();
        $formDatas = $session->get('form_datas');
        $date = $session->get('date');

        // --------vvvvv Datas form Post vvvvv-------
        $token  = $_POST['token'];
        $email  = $_POST['email'];

        // --------vvvvv Datas form Services vvvvv-------
        $formDatas = $session->get('form_datas');
        $customer = $stripeService->getCustomer($email, $token);
        $invoiceAmount = $priceCalService->getTotalPrice($formDatas, $date); 

        // --------vvvvv Entities Manager vvvvv-------
        $em = $this->getDoctrine()->getManager();
        
        // --------vvvvv Logic vvvvv-------
        try {
            $charge = $stripeService->getCharge($customer,$invoiceAmount);
            $orderId = $entitiesSetter->setEntities($formDatas,$date,$email,$em);

            $this->addFlash("success","Bravo ça marche !");
            return $this->redirectToRoute("dr_doh_ticket_billetterie_sending_ticket", array('orderId' => $orderId));

        } catch(\Stripe\Error\Card $e) {
            
            $this->addFlash("error","Snif ça marche pas :(");
            return $this->redirectToRoute("dr_doh_ticket_billetterie_2");
        }
    }

/* -------- \\\\\ Action -=> sendingTicket : Envoye le billet et redirige sur la page d'accueil /////-------- */
    public function sendingTicketAction($orderId)
    {
        // --------vvvvv Datas form Repo vvvvv-------
        $em = $this->getDoctrine()->getManager();
        $buyerRepo = $em->getRepository('DrDohTicketBundle:Buyer');
        $ticketRepo = $this->getDoctrine()->getManager()->getRepository('DrDohTicketBundle:Ticket');
        $buyer = $buyerRepo->findByOrderId($orderId);
        $listTickets = $ticketRepo->findBy(array('buyer'=>$buyer[0]));


        // --------vvvvv DOM PDF vvvvv------- 
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $html = $this->renderView(
            'DrDohTicketBundle:Pdf:pdfView.html.twig', 
            array(
                'listTickets' => $listTickets, 
                'buyer'=> $buyer)
        );
        $dompdf->loadHtml($html);        
        $dompdf->render();
        $pdf = $dompdf->output();

        // --------vvvvv Swift Mailer vvvvv------- 
        $message = \Swift_Message::newInstance();
        $imgUrl = $message->embed(Swift_Image::fromPath('../web/img/logo-louvre.png'));

        $mailer = $this->container->get('mailer');
        $filename = "Le Louvre : Billet d'accées.pdf";
        
        $message->setFrom('ludovic.parhelia@gmail.com')
                ->setTo('ludovic.parhelia@gmail.com')
                ->setSubject('Musée du Louvre : Vos billets d\'accés')
                ->setBody(
                    $this->renderView(
                        'DrDohTicketBundle:Email:emailView.html.twig',
                        array(
                            'listTickets' => $listTickets,
                            'buyer' => $buyer,
                            'img_url'=> $imgUrl,
                        )
                    ),
                'text/html'
                );
                
        $attachement = \Swift_Attachment::newInstance($pdf, $filename, 'application/pdf' );
        $message->attach($attachement);

        $mailer->send($message);
    exit;
    return $this->redirectToRoute("dr_doh_ticket_billetterie");

    }

}