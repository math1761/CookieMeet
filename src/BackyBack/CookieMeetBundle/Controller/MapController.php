<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller
{
    public function AddMapAction()
    {
        return $this->render('BackyBackCookieMeetBundle:Map:map.html.twig');
    }
}