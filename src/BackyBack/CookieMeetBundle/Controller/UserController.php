<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function getUsersAction()
    {
        $users = $this->listUsersAction();
        $currentUser = $this->getCurrentUser();
        return $this->render('BackyBackCookieMeetBundle:User:user.html.twig', array('currentUsers' => $users));
    }

    public function listUsersAction()
    {
       $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        var_dump($users);
        return $users;
    }

    private function getCurrentUser()
    {
        $user = $this->getUser();
        var_dump($user);
    }
}
