<?php

namespace BackyBack\CookieMeetBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Response;

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
    public function getUserAction(Request $request)
    {
        $currentUser = $this->getUser();
        $address = new MapController();
        $serializer = $this->get('jms_serializer');

        $recepee = $this->getDoctrine()
            ->getRepository("BackyBackCookieMeetBundle:AddRecepee")
            ->findAll();

        $data = $this->utf8ize(array(
                'user' => array(
                    'currentUser' => $currentUser,
                    'coordonates' => 'test'
                ))
        );
        $response = new Response();

        var_dump($address->rangeCalculusAction());
        return $response->setContent($serializer->serialize($data, 'json'));
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
