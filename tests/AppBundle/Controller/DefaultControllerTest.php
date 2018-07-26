<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use DrDoh\TicketBundle\Entity\Buyer;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;


class DefaultControllerTest extends WebTestCase
{
    public function testBilleterieisUp()
    {
        
        $client = static::createClient();

        $client->request('GET', '/billetterie/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testBilleterie2isUp()
    {
        $client = static::createClient();

        $client->request('GET', '/billetterie/visiteur');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testStripeisUp()
    {
        $client = static::createClient();
        $buyer = new Buyer;
        $session = new Session(new MockFileSessionStorage());
        $session->set('buyer',$buyer);
        $client->request('GET', '/billetterie/payement');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

    }

    public function testStripeCheckoutisUp()
    {
        $client = static::createClient();

        $client->request('GET', '/billetterie/checkout');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

    }

    public function testSendingTicketisUp()
    {
        $client = static::createClient();

        $client->request('GET', '/billetterie/sendPdf/10');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

    }

}

/*
commande Terminal => ./vendor/bin/simple-phpunit
*/
