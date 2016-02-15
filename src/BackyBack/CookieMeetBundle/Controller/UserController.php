<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function getUsersAction()
    {
        $users = $this->listUsersAction();
        return $this->render('BackyBackCookieMeetBundle:User:user.html.twig', array('users' => $users));
    }

    public function listUsersAction()
    {
       $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();


        /*for ($i = 0; $users > $i; $i++) {
            echo $users;
        }*/

        return $users;
    }
}
