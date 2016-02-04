<?php

/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 04/02/2016
 * Time: 10:50
 */

namespace BackyBack\CookieMeetBundle\Messenger;

use BackyBack\CookieMeetBundle\Controller\MessengerController;
use Hoa\Exception\Exception;

class MessengerClass extends MessengerController
{
    private $username;
    private $message;
    private $list;
    private $send;

    /**
     * @return mixed
     */
    public function getUsername($username)
    {
        return var_dump($this->username);
    }

    /**
     * @param mixed $name
     */
    public function setUsername($username)
    {
        if ($name <= 30) {
            $this->name = $name;
        }
        else
            throw new Exception('Nom trop grand');
    }
}