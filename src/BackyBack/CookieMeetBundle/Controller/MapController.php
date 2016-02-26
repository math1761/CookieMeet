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
use Doctrine\ORM\EntityRepository;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrix;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixStatus;
use Widop\HttpAdapter\CurlHttpAdapter;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;

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
        $range = $this->rangeCalculus();
        $recepee = $this->getUserRecepee();
        $address = $this->getCurrentUserAddress();
        $destinations = $this->getContactAddress();
        $coordonates = $this->getCoordonates();

        $data = $utf->utf8ize(array(
            'currentAddress' => $address,
            'destinations' => $destinations,
            'distance' => $range,
            'coordonates' => $coordonates,
            'recepee' => $recepee
        ));

        $view = $this->view($data);
        return $this->handleView($view);
    }

    /**
     * @return \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse
     * @throws \Ivory\GoogleMap\Exception\DistanceMatrixException
     *
     * Description : calculate distance between to points
     */
    private function rangeCalculus()
    {
        $distanceMatrix = new DistanceMatrix(new CurlHttpAdapter());
        $address = $this->getCurrentUserAddress();
        $dest = $this->getContactAddress();
        $request = new DistanceMatrixRequest();
        $origin = array_map('current', $address);
        $destinations = array_map('current', $dest);

        foreach ($destinations as $destination)
        {
            $request->setOrigins($origin);
            $request->setDestinations(array($destination));
        }


        /*$request2->setOrigins($origin);
        $request->setDestinations(array('20 rue Marceau, Paris, France'));*/
        $response = $distanceMatrix->process($request);

        return array($response);
    }

    /**
     * @return mixed
     *
     * Description: Get coordonnates to
     */
    private function getCoordonates()
    {
        $geocoder = $this->get('ivory_google_map.geocoder');
        $response = $geocoder->geocode('73 Boulevard Berthier');
        $results = $response->getResults();
        foreach($results as $result)
        {
            $location = $result->getGeometry()->getLocation('latitude', 'longitude', true);
        }

        return $location;
    }

    /**
     * @return mixed
     * Description : SQL Request to get only address informations of the user
     */
    private function getUserRecepee()
    {
        $recepee = $this->getDoctrine()->getManager();
        $query = $recepee->createQuery(
            'SELECT p FROM BackyBackCookieMeetBundle:AddRecepee p
             WHERE p.platePrice >= :platePrice ORDER BY p.platePrice ASC')
            ->setParameter('platePrice', '3')
            ->getResult();

        return $query;
    }
    private function getCurrentUserAddress()
    {
        $user = $this->getDoctrine()->getManager();
        $query = $user->createQuery(
            "SELECT p.address FROM BackyBackCookieMeetBundle:User p WHERE p.address = '73 Boulevard Berthier, Paris'")
            ->getResult();

        return $query;
    }

    private function getContactAddress()
    {
        $user = $this->getDoctrine()->getManager();
        $query = $user->createQuery(
            "SELECT p.address FROM BackyBackCookieMeetBundle:User p WHERE p.address != '73 Boulevard Berthier, Paris'")
            ->getResult();

        return $query;
    }

}