<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackyBackCookieMeetBundle:Index:index.html.twig');
    }
}
