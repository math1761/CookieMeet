<?php
/**
 * Created by PhpStorm.
 * User: william
 * Date: 17/02/2016
 * Time: 12:05
 */

namespace BackyBack\CookieMeetBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Guzzle\Http\Message\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Doctrine\Tests\Common\DataFixtures\TestEntity\User;
use FOS\RestBundle\Controller\Annotations\View;
use Guzzle\Http\Message\Response;
use Hoa\Websocket\Server as Serve;
use Hoa\Socket\Server as Socket;
use Hoa\Event\Bucket as Bucket;
use Hoa\Event\Source as Source;
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
        $currentUser = $this->getCurrentUserAction();
        return $this->render("BackyBackCookieMeetBundle:Messenger:messenger.html.twig",array('currentUser' => $currentUser));
    }

    /**
     * @View()
     * @ParamConverter("user", class="BackyBackCookieMeetBundle:User")
     */
    private function getCurrentUserAction()
    {
        $user = $this->getUser();
    }

    /**
     * @Route("/api/messenger")
     * @Method("POST")
     */
    private function getUsersToJSONAction(Request $request)
    {
        $currentUser = $this->getCurrentUserAction();
        $user = $this->getDoctrine()->getRepository('BackyBackCookieMeetBundle:User');
        $request = $this->post('/api/messenger', [
            'users' => json_encode($user)
        ]);
        return $request;
    }

    /**
     * @Route("/api/messenger")
     * @Method("GET")
     */
    private function getUsersToMessageAction(Request $request)
    {
        $user = $this->getUsersToJSONAction($request);
    }

    /**
     * @param Request $request
     * @return Request
     * Create a server and allows users to communicate
     */
    private function createServerAction()
    {
        $server = new Serve(
            new Socket('tcp://127.0.0.1:8889')
        );
        $server->on('message', function (Bucket $bucket) {
            $data = $bucket->getData();

            echo 'message: ', $data['message'], "\n";
            $bucket->getSource()->send($data['message']);
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
    }

}