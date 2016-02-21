<?php
/**
 * Created by PhpStorm.
 * User: Leslie
 * Date: 21/02/2016
 * Time: 21:50
 */

namespace BackyBack\CookieMeetBundle\Tests\TestMessenger;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TestMessenger extends WebTestCase
{
    public function testMessengerRoute()
    {
        $client = static::createClient();

        $client->request("GET", "/api/messenger.json");

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
    }

}
