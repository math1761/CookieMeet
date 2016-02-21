<?php

namespace BackyBack\CookieMeetBundle\Tests\Controller;

use FOS\RestBundle\FOSRestBundle;
use FOS\RestBundle\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;;

class MapAPITest extends WebTestCase
{
    public function testJsonPostPageAction()
    {
        $this->client = static::createClient();
        $this->client->request(
            'POST',
            '/api/map.json',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"title":"title1","body":"body1"}'
        );
        $this->assertJsonResponse($this->client->getResponse(), 201, false);
    }
}