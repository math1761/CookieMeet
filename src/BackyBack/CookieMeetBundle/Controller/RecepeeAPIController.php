<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 23/02/2016
 * Time: 12:03
 */

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackyBack\CookieMeetBundle\Form\AddRecepeeForm;
use Symfony\Component\HttpFoundation\Request;
use BackyBack\CookieMeetBundle\Entity\AddRecepee;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class RecepeeAPIController extends FOSRestController
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
    public function getrecepeeAction(Request $request)
    {
        $response = new Response();
        $utf8 = new UserAPIController();

        $data = $utf8->utf8ize(array(
            'addrecepee' => array(
                'info' => '123'
            )));

        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /*private function getForminfo()
    {

    }*/
}