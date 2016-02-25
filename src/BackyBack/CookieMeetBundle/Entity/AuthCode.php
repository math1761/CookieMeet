<?php

namespace BackyBack\CookieMeetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthCode
 *
 * @ORM\Table(name="auth_code")
 * @ORM\Entity(repositoryClass="BackyBack\CookieMeetBundle\Repository\AuthCodeRepository")
 */
class AuthCode
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

