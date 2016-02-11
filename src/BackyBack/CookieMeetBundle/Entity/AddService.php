<?php

namespace BackyBack\CookieMeetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AddService
 *
 * @ORM\Table(name="add_service")
 * @ORM\Entity(repositoryClass="BackyBack\CookieMeetBundle\Repository\AddServiceRepository")
 */
class AddService
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
     * @var string
     *
     * @ORM\Column(name="plateName", type="string", length=255, nullable=true)
     */
    private $plateName;

    /**
     * @var string
     *
     * @ORM\Column(name="plateCategory", type="string", length=255, nullable=true)
     */
    private $plateCategory;

    /**
     * @var int
     *
     * @ORM\Column(name="platePrice", type="integer", nullable=true)
     */
    private $platePrice;

    /**
     * @var string
     *
     * @ORM\Column(name="plateExcerpt", type="string", length=255, nullable=true)
     */
    private $plateExcerpt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set plateName
     *
     * @param string $plateName
     *
     * @return AddService
     */
    public function setPlateName($plateName)
    {
        $this->plateName = $plateName;

        return $this;
    }

    /**
     * Get plateName
     *
     * @return string
     */
    public function getPlateName()
    {
        return $this->plateName;
    }

    /**
     * Set plateCategory
     *
     * @param string $plateCategory
     *
     * @return AddService
     */
    public function setPlateCategory($plateCategory)
    {
        $this->plateCategory = $plateCategory;

        return $this;
    }

    /**
     * Get plateCategory
     *
     * @return string
     */
    public function getPlateCategory()
    {
        return $this->plateCategory;
    }

    /**
     * Set platePrice
     *
     * @param integer $platePrice
     *
     * @return AddService
     */
    public function setPlatePrice($platePrice)
    {
        $this->platePrice = $platePrice;

        return $this;
    }

    /**
     * Get platePrice
     *
     * @return int
     */
    public function getPlatePrice()
    {
        return $this->platePrice;
    }

    /**
     * Set plateExcerpt
     *
     * @param string $plateExcerpt
     *
     * @return AddService
     */
    public function setPlateExcerpt($plateExcerpt)
    {
        $this->plateExcerpt = $plateExcerpt;

        return $this;
    }

    /**
     * Get plateExcerpt
     *
     * @return string
     */
    public function getPlateExcerpt()
    {
        return $this->plateExcerpt;
    }
}
