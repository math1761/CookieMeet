<?php

namespace BackyBack\CookieMeetBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class HomeController extends FOSRestController
{
    public function getHomeAction()
    {
        $currentUser = $this->get('security.context')->getToken()->getUser();

        $data = array(
                'user' => array(
                    'currentUser' => $currentUser
                )
        );
        $view = $this->view($data);
        return $this->handleView($view);
    }
}
