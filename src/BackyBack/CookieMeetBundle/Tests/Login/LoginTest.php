<?php
/**
 * Created by PhpStorm.
 * User: edenbitton
 * Date: 16/02/2016
 * Time: 19:46
 */

namespace BackyBack\CookieMeetBundle\Tests\Login;

use Symfony\Bridge\PhpUnit;
use Hautelook\AliceBundle\Alice;

class LoginTest
{
   private function testisLoggedIn()
   {
       $stack = array();
       $this->assertEquals(0, count($stack));

       array_push($stack, 'foo');
       $this->assertEquals('foo', $stack[count($stack)-1]);
       $this->assertEquals(1, count($stack));

       $this->assertEquals('foo', array_pop($stack));
       $this->assertEquals(0, count($stack));
   }
}