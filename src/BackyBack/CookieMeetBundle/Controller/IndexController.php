<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class IndexController extends FOSRestController
{
    /**
     * @Route("/")
     * This is the documentation description of your method, it will appear
     * on a specific pane. It will read all the text until the first
     * annotation.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="This is the homepage for the homepage view"
     *
     * )
     */
    public function homepageAction()
    {
        return $this->render('BackyBackCookieMeetBundle:Index:index.html.twig');
    }

    /**
     * @Route("/users")
     */
    public function usersAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        $view = $this->view($users, 200)
            ->setTemplate("BackyBackCookieMeetBundle:Index:users.html.twig")
            ->setTemplateVar('users')
        ;
        return $this->handleView($view);
    }

}
