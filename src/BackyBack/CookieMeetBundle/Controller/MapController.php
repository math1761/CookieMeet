<?php

namespace BackyBack\CookieMeetBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Ivory\GoogleMap\Map;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Request as FOSRequest;
use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\MapTypeId;
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
     *
     * @return View
     */
    public function AddMapAction()
    {
        $mapHelper = new MapHelper();
        $map = $this->configMapAction();

        echo $mapHelper->renderHtmlContainer($map);
        echo $mapHelper->renderJavascripts($map);
        return $this->render('BackyBackCookieMeetBundle:Map:map.html.twig', array(
            'map' => $map));
    }

    public function configMapAction()
    {
        $map = new Map();

        /*$marker = $this->markerConfigAction($map);*/
        /*$map->addMarker($marker);*/
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
        /*$map->addMarker($marker);*/

        $map->setLanguage('fr');

        return $map;
    }

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


    private function geocodeAction(Request $request)
    {
        // Retrieve information from the current user (by its IP address)
        $result = $this->container
            ->get('bazinga_geocoder.geocoder')
            ->using('google_maps')
            ->geocode($request->server->get('REMOTE_ADDR'));

        return array(
            'geocoded'        => $result,
            'nearest_objects' => $objects
        );
    }

    private function retrieveUserbyAddress(Request $request)
    {
        $request = $this
            ->getDoctrine()
            ->getRepository('BackyBackCookieMeetBundle:User')
            ->find($address);

        foreach ($request as $key)
        {
            echo $key->getContent();
        }
        if (!$request) {
            throw $this->createNotFoundException('No address found '.$address);
        }
        var_dump($request);

        return $request;
    }
}