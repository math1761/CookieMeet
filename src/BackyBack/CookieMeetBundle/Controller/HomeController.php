<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class HomeController extends Controller
{
    /**
     * @ApiDoc(
     *  resource=true,
     *  description="This is the homepage for the homepage view"
     * )
     */
    public function getHomeAction()
    {
        return $this->render("BackyBackCookieMeetBundle:Home:index.html.twig");
    }
}
