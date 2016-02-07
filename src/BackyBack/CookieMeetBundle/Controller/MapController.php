<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackyBack\CookieMeetBundle\MapContent\Gmaps;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class MapController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ApiDoc(
     *  resource=true,
     *  description="Configuration function for google maps"
     *
     * )
     */
    public function AddMapAction()
    {
        $map = $this->get('ivory_google_map.map');

        $map->setPrefixJavascriptVariable('map_');
        $map->setHtmlContainerId('map_canvas');

        $map->setAsync(false);
        $map->setAutoZoom(true);

        $map->setCenter(0, 0, true);
        $map->setMapOption('zoom', 3);

        $map->setBound(48.856614, 2.352222
            , 2.6, 1.4, true, true);

        $map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
        $map->setMapOption('mapTypeId', 'roadmap');

        $map->setMapOption('disableDefaultUI', true);
        $map->setMapOption('disableDoubleClickZoom', true);
        $map->setMapOptions(array(
            'disableDefaultUI' => true,
            'disableDoubleClickZoom' => true,
        ));

        /*$map->setStylesheetOption('width', '300px');
        $map->setStylesheetOption('height', '300px');*/
        $map->setStylesheetOptions(array(
            'width' => '1000px',
            'height' => '500px',
        ));

        $map->setLanguage('fr');
        return $this->render('BackyBackCookieMeetBundle:Map:map.html.twig', array('map' => $map));
    }
}