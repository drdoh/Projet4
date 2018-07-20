<?php 

namespace DrDoh\TicketBundle\Services;

use Dompdf\Options;
use Dompdf\Dompdf;

class DrDohSendTickets
{
    

    private $templating;

    public function __construct($templating, $mailer)
    {
        $this->templating = $templating;
        $this->mailer = $mailer;
    }
    
    private function createPdf($buyer, $listTickets)
    {
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $html = $this->templating->render(
            'DrDohTicketBundle:Pdf:pdfView.html.twig', 
            array(
                'buyer'=> $buyer,
                'listTickets' => $listTickets,
            ) 
        );
        $dompdf->loadHtml($html);        
        $dompdf->render();
        $pdf = $dompdf->output();

        return $pdf;
    }

    public function sendTickets($formDatas){
        var_dump($formDatas->getTicket());
        $message = \Swift_Message::newInstance();
        $imgUrl = $message->embed(\Swift_Image::fromPath('../web/img/logo-louvre.png'));

        $filename = "Le Louvre : Billet d'accées.pdf";
        
        $message->setFrom('ludovic.parhelia@gmail.com')
                ->setTo('ludovic.parhelia@gmail.com')
                ->setSubject('Musée du Louvre : Vos billets d\'accés')
                ->setBody(
                    $this->templating->render(
                        'DrDohTicketBundle:Email:emailView.html.twig',
                        array(
                            'listTickets' => $listTickets,
                            'buyer' => $buyer,
                            'img_url'=> $imgUrl,
                        )
                    ),
                'text/html'
                );
        
        $pdf = $this->createPdf($buyer, $listTickets);
        
        $attachement = \Swift_Attachment::newInstance($pdf, $filename, 'application/pdf' );
        $message->attach($attachement);

        $this->mailer->send($message);
    }
}