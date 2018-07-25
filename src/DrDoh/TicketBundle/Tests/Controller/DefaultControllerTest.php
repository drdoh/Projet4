<?php

namespace DrDoh\TicketBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/billetterie/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
