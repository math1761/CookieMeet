<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 17/02/2016
 * Time: 12:05
 */

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MessengerController extends Controller
{
    public function getMessengerAction()
    {
        return $this->render("BackyBackCookieMeetBundle:Messenger:messenger.html.twig");
    }
}