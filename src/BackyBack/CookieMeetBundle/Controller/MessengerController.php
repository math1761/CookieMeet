<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 17/02/2016
 * Time: 12:05
 */

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Doctrine\UserManager;

class MessengerController extends Controller
{
    public function getMessengerAction()
    {
        return $this->render("BackyBackCookieMeetBundle:Home:index.html.twig");
    }
}
