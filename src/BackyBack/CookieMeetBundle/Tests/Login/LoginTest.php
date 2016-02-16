<?php
/**
 * Created by PhpStorm.
 * User: edenbitton
 * Date: 16/02/2016
 * Time: 19:46
 */

namespace BackyBack\CookieMeetBundle\Tests\Login;


class LoginTest extends PHPUnit_Framework_TestCase
{
   private function isLoggedTest()
   {
       $user = $this->container->get('security.context')->getToken()->getUser();
       $user->getlocation();
       var_dump($user);

   }
}