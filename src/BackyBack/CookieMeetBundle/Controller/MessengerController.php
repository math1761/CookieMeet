<?php
/**
 * Created by PhpStorm.
 * User: william
 * Date: 17/02/2016
 * Time: 12:05
 */

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Doctrine\Tests\Common\DataFixtures\TestEntity\User;
use FOS\RestBundle\Controller\Annotations\View;
use Hoa\Websocket\Server as Serve;
use Hoa\Socket\Server as Socket;
use Hoa\Event\Bucket as Bucket;
use Hoa\Event\Source as Source;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use BackyBack\CookieMeetBundle\Controller\UserAPIController;

/**
 * Class MessengerController
 * @package BackyBack\CookieMeetBundle\Controller
 */
class MessengerController extends FOSRestController
{
    /**
     * Return messenger
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Get the messenger's route",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the messenger doesn't respond"
     *   }
     * )
     *
     * @return View
     */
    public function getMessengerAction()
    {
        $currentUser = $this->getUser();

        var_dump($currentUser);
        $response = new Response();
        $response->setContent(json_encode(array(
                'messenger' => array(
                    'currentUser' => $currentUser,
                    'contact' => 'John Doe'
                ))
        ));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    private function getContact()
    {
        $contact = new UserAPIController();
    }
    private function getUsersToJSONAction(Request $request)
    {
        $user = $this->getDoctrine()->getRepository('BackyBackCookieMeetBundle:User');
        $request = $this->post('/api/messenger', [
            'users' => json_encode($user)
        ]);
        return $request;
    }

    /**
     * @param Request $request
     * @return Request
     * Create a server and allows users to communicate
     */
    private function createServerAction()
    {
        $serve = new Serve(
            new Socket('tcp://127.0.0.1:8889')
        );
        return $serve;
    }

    /**
     * Prepare message sending
     */
    private function sendToClosestUserAction()
    {
        $serve = $this->createServerAction();
        $serve->on('message', function (Bucket $bucket) {
            $data = $bucket->getData();

            echo 'message: ', $data['message'], "\n";
            $bucket->getSource()->send($data['message']);

            return;
        });

        $serve->run();
    }

}