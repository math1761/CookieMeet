<?php

namespace BackyBack\CookieMeetBundle\Controller;

use BackyBack\CookieMeetBundle\Map\GeocodeClass;
use BackyBack\CookieMeetBundle\Map\MapConfig;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Helper\MapHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller
{
    public function AddMapAction()
    {
        $mapping = new MapConfig();
        $mapHelper = new MapHelper();

        $map = $mapping->configMapAction($mapping);

        echo $mapHelper->renderHtmlContainer($map);
        echo $mapHelper->renderJavascripts($map);
        return $this->render('BackyBackCookieMeetBundle:Map:map.html.twig', array(
            'map' => $map));
    }
}