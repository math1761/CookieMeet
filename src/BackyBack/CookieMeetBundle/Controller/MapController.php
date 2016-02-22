<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class MapController extends FOSRestController
{
    /**
     * Return map
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the User's address List",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user's address is not found"
     *   }
     * )
     */
    public function geocodeAction(Request $request)
    {
        $curl     = new \Ivory\HttpAdapter\CurlHttpAdapter();
        $geocoder = new \Geocoder\Provider\GoogleMaps($curl);

        $geocoder->geocode('73 Boulevard Berthier');

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        return $response->setContent(json_encode(array(
            'coordonnees' => $geocoder
        )));
    }

    /*public function configMapAction()
    {
        $map = new Map();

        $marker = $this->markerConfigAction($map);
        $map->addMarker($marker);
        $map->setPrefixJavascriptVariable('map_');
        $map->setHtmlContainerId('map_canvas');

        $map->setCenter(48.856614, 2.352222, true);

        $map->setMapOption('zoom', 12);
        $map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
        $map->setMapOption('mapTypeId', 'roadmap');
        $map->setMapOption('disableDoubleClickZoom', false);
        $map->setMapOptions(array(
            'disableDefaultUI'       => false,
            'disableDoubleClickZoom' => false,
        ));
        $map->setStylesheetOptions(array(
            'width'  => '600px',
            'height' => '600px',
        ));
        $map->addMarker($marker);

        $map->setLanguage('fr');

        return $map;
    }*/

    /*public function addMarkerAction($marker)
    {
        $marker = new Marker();

        foreach($response->getResults() as $result) {
            $marker->setAnimation(Animation::DROP);
            $marker->setOptions(array(
                'clickable' => true,
                'flat' => true,
            ));
        }
        return $marker;
    }*/
}