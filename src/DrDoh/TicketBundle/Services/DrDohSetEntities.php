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
        $priceDatas = $this->price_cal->getPricesArray($formDatas,$date);
        $totalPrice = $this->price_cal->getTotalPrice($formDatas, $date);
        $buyer = new Buyer();
        $buyer->setAmountPaid($totalPrice)
                ->setEmail($email);
        var_dump($date);
        $date = \DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');

        foreach($formDatas->getFirstName() as $key => $firstName)
        {
            $uPrice = $priceDatas[$key-1]['price'];
            $priceType = $priceDatas[$key-1]['type'];
            

            $ticket = new Ticket();
            $ticket ->setLastName($formDatas->getLastName()[$key])
                    ->setFirstName($firstName)
                    ->setCountry($formDatas->getCountry()[$key])
                    ->setBirthDate(new \DateTime($formDatas->getBirthdate()[$key]))
                    ->setDiscount($formDatas->getDiscount()[$key])
                    ->setDate(new \DateTime($date))
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