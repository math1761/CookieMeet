<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackyBack\CookieMeetBundle\Controller\UserAPIController;
use FOS\RestBundle\View\View;
use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResult;
use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderStatus;
use Ivory\GoogleMap\Services\Geocoding\GeocoderRequest as MapRequest;
use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderGeometry;

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
        $utf = new UserAPIController();
        $geocoder = $this->get('ivory_google_map.geocoder');
        $response = $geocoder->geocode('73 Boulevard Berthier, Paris');
        $map = $this->get('ivory_google_map.map');
        $address = $this->parseUsersAddressAction();

        foreach($response->getResults() as $result)
        {
            // Request the google map merker service
            $marker = $this->get('ivory_google_map.marker');

            // Position the marker
            $marker->setPosition($result->getGeometry()->getLocation());

            // Add the marker to the map
            $map->addMarker($marker);
        }

        $data = $utf->utf8ize(array(
            'coordonnees' => $address,
            'maps' => var_dump($result)
        ));


        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        return $response->setContent(json_encode($data));
    }

    private function parseUsersAddressAction()
    {
        $address = $this->getDoctrine()
            ->getRepository('BackyBackCookieMeetBundle:User')
            ->find('address');

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        return $response->setContent(json_encode($address));
    }
}