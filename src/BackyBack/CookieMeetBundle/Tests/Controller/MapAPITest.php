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

        $crawler = $client->request('GET', '/post/hello-world');
        $this->crawler->request(
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