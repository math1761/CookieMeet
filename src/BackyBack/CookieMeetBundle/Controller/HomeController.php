<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class HomeController extends Controller
{
    public function getHomeAction()
    {
        return $this->render("BackyBackCookieMeetBundle:Home:index.html.twig");
    }
}
