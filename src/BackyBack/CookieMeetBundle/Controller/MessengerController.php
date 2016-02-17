<?php
/**
 * Created by PhpStorm.
 * User: william
 * Date: 17/02/2016
 * Time: 12:05
 */

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MessengerController extends Controller
{
    public function getMessengerAction()
    {
        return $this->render("BackyBackCookieMeetBundle:Messenger:messenger.html.twig");
    }


    public function showUsersAction()
    {

        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('BackyBackCookieMeetBundle:User')->findAll();

        return $this->render('@User/Messenger/messenger.html.twig', array(
            'users' => $users,
        ));

    }

}