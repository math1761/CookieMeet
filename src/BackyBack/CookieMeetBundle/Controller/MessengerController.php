<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackyBack\CookieMeetBundle\Form\AddServiceForm;

class MessengerController extends Controller
{
    public function MessengerAction()
    {
        return $this->render('BackyBackCookieMeetBundle:Messenger:messenger.html.twig');
    }
}