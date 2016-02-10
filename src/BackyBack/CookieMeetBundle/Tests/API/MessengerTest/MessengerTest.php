<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 07/02/2016
 * Time: 10:54
 */

namespace BackyBack\CookieMeetBundle\Tests\API\MessengerTest;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as testo;
use BackyBack\CookieMeetBundle\Controller\MessengerController;

class MessengerTest extends testo
{
    public function testMessengerRoute()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/messenger');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
