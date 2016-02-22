<?php

namespace BackyBack\CookieMeetBundle\Tests\Controller;

use FOS\RestBundle\FOSRestBundle;
use FOS\RestBundle\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Tests\Data\Provider\Json;

class MapAPITest extends WebTestCase
{
    public function testisJsonCreated()
    {
        $client = static::createClient();

        $client->request("GET", "/api/map/dd.json");

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
    }
}