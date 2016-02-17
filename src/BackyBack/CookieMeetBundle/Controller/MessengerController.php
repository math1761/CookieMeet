<?php
/**
 * Created by PhpStorm.
 * User: william
 * Date: 17/02/2016
 * Time: 12:05
 */

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class MessengerController
 * @package BackyBack\CookieMeetBundle\Controller
 */
class MessengerController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMessengerAction()
    {
        $currentUser = $this->getCurrentUserAction();
        return $this->render("BackyBackCookieMeetBundle:Messenger:messenger.html.twig",array('currentUser' => $currentUser));
    }


    /**
     * @return mixed
     */
    public function getCurrentUserAction()
    {
        $currentUser = $this->getUser();
        return $currentUser;
    }

}