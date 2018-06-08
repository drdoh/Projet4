<?php
// src/DataFixtures/AppFixtures.php
namespace DrDoh\TicketBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DrDoh\TicketBundle\Entity\Discount;

class LoadDiscount extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $discountsType = array(
            '',
            'Etudiant',
            'Militaire',
            'Employé de musée',
            'Ministere de la culture'
        );
        
        foreach($discountsType as $discountType){
            $discount = new Discount;
            $discount->setType($discountType);

            $manager->persist($discount);
        }

        $manager->flush();
    }
}