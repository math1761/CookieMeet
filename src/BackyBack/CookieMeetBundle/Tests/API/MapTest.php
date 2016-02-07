<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 07/02/2016
 * Time: 10:54
 */

namespace BackyBack\CookieMeetBundle\Tests\API;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MapTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
