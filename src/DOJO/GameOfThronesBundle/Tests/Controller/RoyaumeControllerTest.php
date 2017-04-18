<?php

namespace DOJO\GameOfThronesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoyaumeControllerTest extends WebTestCase
{
    public function testAddroyaume()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addRoyaume');
    }

}
