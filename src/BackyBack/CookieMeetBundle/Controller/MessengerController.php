<?php
/**
 * Created by PhpStorm.
 * User: william
 * Date: 17/02/2016
 * Time: 12:05
 */

namespace BackyBack\CookieMeetBundle\Controller;

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

        $response = new Response();
        $response->setContent(json_encode(array(
                'messenger' => array(
                    'currentUser' => $currentUser,
                    'contact' => 'John Doe',
                    'message' => array(
                        'sent' => '123',
                        'received' => '456'),
                ))
        ));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/api/messenger")
     * @Method("POST")
     */
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
        $server = new Server(
            new Socket('tcp://127.0.0.1:8889')
        );
        /*
        $server->on('message', function (Bucket $bucket) {
            $data = $bucket->getData();

            echo 'message: ', $data['message'], "\n";
            $bucket->getSource()->send($data['message']);
        });
        */
        $server->on('message', function (Bucket $bucket) {
            $bucket->getSource()->send('Hey tu es dispo quand pour une pizza ? :)');

            return;
        });
        $server->run();
    }

    /**
     * @Route("/api/messenger")
     * @Method("POST")
     * Get previous message sent into JSON
     */
    private function postMessagetoJSONAction(Request $request)
    {
        $response = $this->createServerAction();

        return $request;
    }

    /**
     * @Route("/api/messenger")
     * @Method("GET")
     * Get previous message sent and decode it
     */
    private function getMessagefromJSONAction(Request $request)
    {
        $response = $this->postMessagetoJSONAction($request);

        $client = new Websocket(
            new Socket('tcp://127.0.0.1:8889')
        );
        $client->receive();
        $client->on('message', function (Event $bucket) {
            $data = $bucket->getData();
            echo 'received message: ', $data['message'], "\n";

            return;
        });


        //pas sur que le request en param soit utile
        //retranscrire le json obtenu au dessus en affichage
        //pas de return vu que le get en fait un tout seul

    }

}