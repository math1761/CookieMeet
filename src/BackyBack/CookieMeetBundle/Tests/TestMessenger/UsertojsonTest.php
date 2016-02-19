<?php
/**
 * Created by PhpStorm.
 * User: edenbitton
 * Date: 19/02/2016
 * Time: 17:41
 */

namespace BackyBack\CookieMeetBundle\Tests\TestMessenger;

use Nelmio\ApiDocBundle\Tests\WebTestCase;

class Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @return string
     */
    public function UsertojsonTest()
    {
     $client = static::createClient();

     $crawler = $client->request('GET', '/api/messenger');
     $em = "tutu";

     $tojson =  json_encode($em);

     $crawler = $this->assertTrue($tojson);

     return $tojson;
    }
}
