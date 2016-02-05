<?php

/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 04/02/2016
 * Time: 10:50
 */

namespace BackyBack\CookieMeetBundle\Messenger;

use BackyBack\CookieMeetBundle\Controller\MessengerController as Message;
use Hoa\Socket\Server as ServSocket;
use Hoa\Websocket\Server as ServWebSocket;


class MessengerClass extends Message
{
    private $server;

    public function __construct()
    {
        $this->server = serverlaunchAction();
    }

    /**
     * Function starts websocket server
     * @return $server
     */
    protected function serverlaunchAction($server)
    {
        $server = new ServWebSocket(
            new ServSocket('tcp://127.0.0.1:8889')
        );
        return $this->server;
    }

    /*protected function serverlistenAction() {
        $this->$server
        $this->serverlaunchAction($server);
    }*/
}