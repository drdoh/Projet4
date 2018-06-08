<?php
// src/DataFixtures/AppFixtures.php
namespace DrDoh\TicketBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DrDoh\TicketBundle\Entity\Ticket;
//use Symfony\Component\Validator\Constraints\DateTime;

class LoadTicket extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $datas = array(
            '2018-06-30',
            '2018-07-15',
            '2018-08-30',
            '2018-06-30',
            '2018-06-30'
        );
        
        foreach($datas as $data){
            $date = new Ticket;
            $data = date_create($data);

            $date->setDate($data);
            
            $uniqueId =  sha1(uniqid('',true)); 
            $date->setTicketId($uniqueId);
            
            $manager->persist($date);
        }

        $manager->flush();
    }
}