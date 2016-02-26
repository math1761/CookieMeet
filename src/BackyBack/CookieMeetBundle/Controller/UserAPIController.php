<?php

namespace BackyBack\CookieMeetBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use JMS\Serializer\SerializationContext;
use BackyBack\CookieMeetBundle\Controller\MapController;

class UserAPIController extends FOSRestController
{
    /**
     * Return the overall user informations.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall User Informations",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when one of the information is not found"
     *   }
     * )
     *
     */
    public function getUserAction()
    {
        $user = $this->getUser();

        $address = new MapController();
        $location = $address->geocodeAction();

        var_dump($location);
        $data = $this->utf8ize(array(
                'user' => array(
                    'currentUser' => $user
                ))
        );

        $view = $this->view($data);
        return $this->handleView($view);
    }

    /**
     * @param $d
     * @return array|string
     *
     * This function force convert to UTF-8 all the strings contained in an array
     * it solves the problem of empty object with json_encode
     */
    public function utf8ize($d) {
        if (is_array($d))
            foreach ($d as $k => $v)
                $d[$k] = $this->utf8ize($v);

        else if(is_object($d))
            foreach ($d as $k => $v)
                $d->$k = $this->utf8ize($v);

        else
            return utf8_encode($d);

        return $d;
    }
}
