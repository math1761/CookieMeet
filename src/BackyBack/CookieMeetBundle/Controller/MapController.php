<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandler;
use Doctrine\ORM\EntityRepository;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrix;
use Widop\HttpAdapter\CurlHttpAdapter;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest;

class MapController extends FOSRestController
{
    /**
     * Return map
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "This class gives you all the informations to calculate range between users,
     *   coordonates and recepee access example",
     *   statusCodes = {
     *     200 = "Returned when the successful",
     *     404 = "Returned when the user's address is not found"
     *   }
     * )
     *
     *
     *
     */
    public function geocodeAction()
    {
        $utf = new UserAPIController();
        $range = $this->rangeCalculus();
        $recepee = $this->getUserRecepee();
        $address = $this->getCurrentUserAddress();
        $coordonates = $this->getCoordonates();

        $data = $utf->utf8ize(array(
            'currentAddress' => $address,
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

        $request->setOrigins($origin);
        $request->setDestinations(array('20 rue Marceau, Paris, France'));
        $response = $distanceMatrix->process($request);

        return $response;
    }

    /**
     * @return float
     *  Description : When done, this function returns the distance between two points
     *
     */
    /*private function distanceCalculus()
    {
        $status = $this->rangeCalculus();

        $elements = new DistanceMatrixResponseElement($status);
        $distance = $elements->getDistance()->getValue();

        return $distance;
    }*/

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