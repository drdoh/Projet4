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

    public function setEntities($orderedKeys,$date,$em)
    {
        $totalPrice = $this->price_cal->getTotalPrice($orderedKeys, $date);
        $buyerData = [];
        foreach($orderedKeys->getFirstName() as $key => $firstName)
        {
            $uPrice = $this->price_cal->getUPrice($this->price_cal->getGuestAge($orderedKeys->getBirthDate()[$key],$date),$orderedKeys->getDiscount()[$key]);
            $priceType = $this->price_cal->getPriceType($this->price_cal->getGuestAge($orderedKeys->getBirthDate()[$key],$date),$orderedKeys->getDiscount()[$key]);

            if($key > 1){

                $ticket = new Ticket();
                $ticket ->setDate($date)
                        ->setValue($uPrice)
                        ->setType($priceType);

                $guest = new Guest();
                $guest  ->setFirstName($firstName)
                        ->setLastName($orderedKeys->getLastName()[$key])            
                        ->setCountry($orderedKeys->getCountry()[$key])             
                        ->setBirthDate($orderedKeys->getBirthDate()[$key])
                        ->setDiscount($orderedKeys->getDiscount()[$key])
                        ->setAgreed($orderedKeys->getAgreed())
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
                        ->setLastName($orderedKeys->getLastName()[$key])
                        ->setEmail($orderedKeys->getEmail()[$key])
                        ->setBirthDate($orderedKeys->getBirthDate()[$key])
                        ->setDiscount($orderedKeys->getDiscount()[$key])
                        ->setAgreed($orderedKeys->getAgreed())
                        ->setCountry($orderedKeys->getCountry()[$key])
                        ->setAmountPaid($totalPrice)
                        ->setTicket($ticket);
                
                $em->persist($ticket);        
                $em->persist($buyer);
                
                $buyerData = array(
                    'Nom' => $firstName, 
                    'Prenom' => $orderedKeys->getLastName()[$key],
                    'email' => $orderedKeys->getEmail()[$key],
                    'invoice_amount' => $totalPrice
                );
            }
            
        }
        $em->flush();
        return $buyerData;
    }

}