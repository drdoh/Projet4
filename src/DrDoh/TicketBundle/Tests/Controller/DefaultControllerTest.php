<?php

namespace DrDoh\TicketBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndexisUp()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/billetterie/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        echo $client->getReponse();
    }
}
