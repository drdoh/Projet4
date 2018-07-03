<?php 

namespace DrDoh\TicketBundle\Services;

use DrDoh\TicketBundle\Entity\Ticket;
use DrDoh\TicketBundle\Entity\Guest;
use DrDoh\TicketBundle\Entity\Buyer;

class DrDohSetEntities
{
        
    public function __construct($priceCal)
    {
        $this->price_cal = $priceCal;
    }

    public function setEntities($formDatas,$date,$em)
    {


        $totalPrice = $this->price_cal->getTotalPrice($formDatas, $date);
        $buyerData = [];
        foreach($formDatas->getFirstName() as $key => $firstName)
        {
            $uPrice = $this->price_cal->getUPrice($this->price_cal->getGuestAge($formDatas->getBirthDate()[$key],$date),$formDatas->getDiscount()[$key]);
            $priceType = $this->price_cal->getPriceType($this->price_cal->getGuestAge($formDatas->getBirthDate()[$key],$date),$formDatas->getDiscount()[$key]);

            if($key > 1){

                $ticket = new Ticket();
                $ticket ->setDate($date)
                        ->setValue($uPrice)
                        ->setType($priceType);

                $guest = new Guest();
                $guest  ->setFirstName($firstName)
                        ->setLastName($formDatas->getLastName()[$key])            
                        ->setCountry($formDatas->getCountry()[$key])             
                        ->setBirthDate($formDatas->getBirthDate()[$key])
                        ->setDiscount($formDatas->getDiscount()[$key])
                        ->setAgreed($formDatas->getAgreed())
                        ->setTicket($ticket);

                $em->persist($ticket);
                $em->persist($guest);

            }else{
                
                $ticket = new Ticket();
                $ticket ->setDate($date)
                        ->setValue($uPrice)
                        ->setType($priceType);
                
                $buyer = new Buyer();
                $buyer  ->setFirstName($firstName)
                        ->setLastName($formDatas->getLastName()[$key])
                        ->setEmail($formDatas->getEmail()[$key])
                        ->setBirthDate($formDatas->getBirthDate()[$key])
                        ->setDiscount($formDatas->getDiscount()[$key])
                        ->setAgreed($formDatas->getAgreed())
                        ->setCountry($formDatas->getCountry()[$key])
                        ->setAmountPaid($totalPrice)
                        ->setTicket($ticket);
                
                $em->persist($ticket);        
                $em->persist($buyer);
                
           }
            
        }
        $em->flush();
        var_dump($em);
        exit;
    }

}