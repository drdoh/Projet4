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
        $session = $request->getSession(); 
        $date = $session->get('date');

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
        $stripeService = $this->container->get('dr_doh_services.stripe');
        $priceCalService = $this->container->get('dr_doh_services.price_cal');
        
        $session = $request->getSession(); 
        $formDatas = $session->get('form_datas');
        $date = $session->get('date');
        $prices = $priceCalService->getPrices($formDatas, $date);
        $invoiceAmount = $priceCalService->getTotalPrice($formDatas, $date); 
        $PriceType = $priceCalService->getPriceTypeArray($formDatas, $date);
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
    
    public function sendingTicketAction($orderId)
    {
        // On récupère l'objet à afficher (rien d'inconnu jusque là)
        $em = $this->getDoctrine()->getManager();
        $buyerRepo = $em->getRepository('DrDohTicketBundle:Buyer');
        $buyer = $buyerRepo->findByOrderId($orderId);
        $ticketRepo = $this->getDoctrine()->getManager()->getRepository('DrDohTicketBundle:Ticket');
        $listTickets = $ticketRepo->findBy(array('buyer'=>$buyer[0]));
   
        // On crée une  instance pour définir les options de notre fichier pdf
        $options = new Options();
        // Pour simplifier l'affichage des images, on autorise dompdf à utiliser 
        // des  url pour les nom de  fichier
        $options->set('isRemoteEnabled', TRUE);
        // On crée une instance de dompdf avec  les options définies
        $dompdf = new Dompdf($options);
        // On demande à Symfony de générer  le code html  correspondant à 
        // notre template, et on stocke ce code dans une variable
        $html = $this->renderView(
            'DrDohTicketBundle:Pdf:pdfView.html.twig', 
            array(
                'listTickets' => $listTickets, 
                'buyer'=> $buyer)
        );
        // On envoie le code html  à notre instance de dompdf
        $dompdf->loadHtml($html);        
        // On demande à dompdf de générer le  pdf
        $dompdf->render();
    
    $mailer = $this->container->get('mailer');

        $message = (\Swift_Message::newInstance())
            ->setFrom('ludovic.parhelia@gmail.com')
            ->setTo('ludovic.parhelia@gmail.com')
            ->setBody('Hello','text/plain');

    $mailer->send($message);
    var_dump($mailer,$message);
    exit;
    // or, you can also fetch the mailer service this way
    // $this->get('mailer')->send($message);

        // On renvoie  le flux du fichier pdf dans une  Response pour l'utilisateur
        return new Response ($dompdf->stream());

    }

}