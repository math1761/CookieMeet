<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 15/02/2016
 * Time: 14:16
 */

namespace BackyBack\CookieMeetBundle\Controller\API;

use Doctrine\Tests\Common\DataFixtures\TestEntity\User;
use FOS\RestBundle\Controller\Annotations\View;
use Guzzle\Http\Message\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class MapAPIController extends Controller
{
    /**
     * @Route("/api/map")
     * @return array
     * @View()
     */
    public function getMapAction(Request $request)
    {
        // Retrieve information from the current user (by its IP address)
        $result = $this->container
            ->get('bazinga_geocoder.geocoder')
            ->using('google_maps')
            ->geocode($request->server->get('REMOTE_ADDR'));

        // Find the 5 nearest objects (15km) from the current user.
        $address = $result->first();
        $objects = ObjectQuery::create()
            ->filterByDistanceFrom($address->getLatitude(), $address->getLongitude(), 15)
            ->limit(5)
            ->find();

        return array(
            'geocoded'        => $result,
            'nearest_objects' => $objects
        );
    }

    /**
     * @param User $user
     * @return array
     * @View()
     * @ParamConverter("user", class="BackyBackCookieMeetBundle:User")
     */
    private function getMapsAction(User $user)
    {
        $useraddress = $this->getDoctrine()->getRepository('BackyBackCookieMeetBundle:User')
           ->findBy()

        return array('users' => $users);
    }
}