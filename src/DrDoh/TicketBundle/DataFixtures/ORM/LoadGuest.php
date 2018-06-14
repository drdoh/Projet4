<?php
// src/DataFixtures/AppFixtures.php
namespace DrDoh\TicketBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DrDoh\TicketBundle\Entity\Guest;
use DrDoh\TicketBundle\Entity\Ticket;
use DrDoh\TicketBundle\Entity\Discount;
//use Symfony\Component\Validator\Constraints\DateTime;

class LoadGuest extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $guest1 = new Guest;

        $guest1->setLastName('Ludovic');
        $guest1->setFirstName('GERMAIN');
        $guest1->setBirthDate(new \DateTime);
            $ticket1 = new Ticket();
            $ticket1->setTicketId(123456789);
            $ticket1->setDate(new \DateTime);
        $guest1->setTicket($ticket1);
            $discount1 = new Discount;
            $discount1->setType('');
        $guest1->setDiscountType($discount1);
        

        $manager->persist($guest1);
        

        $manager->flush();
    }
}