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
use FOS\RestBundle\View\ViewHandler;
use JMS\Serializer\SerializationContext;
use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResult;
use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderStatus;
use Ivory\GoogleMap\Services\Geocoding\GeocoderRequest as MapRequest;
use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderGeometry;
use Ivory\GoogleMap\Services\Geocoding\GeocoderProvider;
use Ivory\GoogleMap\Exception\GeocodingException;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrix;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixElement;
use Ivory\GoogleMap\Services\Base\Distance;
use Widop\HttpAdapter\CurlHttpAdapter;

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
     */
    public function geocodeAction()
    {
        $utf = new UserAPIController();
        $geocoder = $this->get('ivory_google_map.geocoder');
        $response = $geocoder->geocode('73 Boulevard Berthier, Paris');
        $results = $response->getResults();
        $range = $this->rangeCalculusAction();
        $serializer = $this->get('jms_serializer');

        foreach($results as $result)
        {
            $location = $result->getGeometry()->getLocation('latitude', 'longitude', true);
        }

        $data = $utf->utf8ize(array(
            'coordonnees' => array($location),
            'distance' => array($range)
        ));


        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        return $response->setContent($serializer->serialize($data, 'json'));
    }

    /*private function parseUsersAddressAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        return $response->setContent(json_encode($address));
    }*/

    public function rangeCalculusAction()
    {
        $distanceMatrix = new DistanceMatrix(new CurlHttpAdapter());

        $elements = $distanceMatrix->process(array('15 rue Marceau, Paris, France'), array('73 Boulevard Berthier, France'));

        foreach ($elements as $element) {
            $distance = $element->getDistance();
        }

        return $distance;
    }
}