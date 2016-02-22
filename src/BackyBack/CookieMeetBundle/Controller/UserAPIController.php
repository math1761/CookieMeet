<?php

namespace BackyBack\CookieMeetBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
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
    public function getUserAction()
    {
        $currentUser = $this->getUser();

        $recepee = $this->getDoctrine()
            ->getRepository("BackyBackCookieMeetBundle:AddRecepee")
            ->findAll();

        $response = new Response();
        $response->setContent(json_encode(array(
            'user' => array(
                'currentUser' => $currentUser,
                'coordonates' => array(
                    'lat' => '123',
                    'long' => '456'),
                'recepee' => $recepee
                ))
        ));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
