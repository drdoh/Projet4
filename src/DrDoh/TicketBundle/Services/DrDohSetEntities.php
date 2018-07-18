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

    public function setEntities($formDatas,$date,$email,$em)
    {
        $totalPrice = $this->price_cal->getTotalPrice($formDatas, $date);
        $buyer = new Buyer();
        $buyer->setAmountPaid($totalPrice)
                ->setEmail($email);

        foreach($formDatas->getFirstName() as $key => $firstName)
        {
            $uPrice = $this->price_cal->getUPrice($this->price_cal->getGuestAge(new \DateTime($formDatas->getBirthDate()[$key]),$date),$formDatas->getDiscount()[$key]);
            $priceType = $this->price_cal->getPriceType($this->price_cal->getGuestAge(new \DateTime($formDatas->getBirthDate()[$key]),$date),$formDatas->getDiscount()[$key]);
            
            $ticket = new Ticket();
            $ticket ->setLastName($formDatas->getLastName()[$key])
                    ->setFirstName($firstName)
                    ->setCountry($formDatas->getCountry()[$key])
                    ->setBirthDate(new \DateTime($formDatas->getBirthDate()[$key]))
                    ->setDiscount($formDatas->getDiscount()[$key])
                    ->setDate($date)
                    ->setValue($uPrice)
                    ->setType($priceType)
                    ->setBuyer($buyer);

            $em->persist($ticket);        
        }
        
        $em->persist($buyer);
        $em->flush();

        return $buyer->getOrderId();
    }
}