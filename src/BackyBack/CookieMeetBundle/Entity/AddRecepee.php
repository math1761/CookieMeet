<?php

namespace BackyBack\CookieMeetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AddRecepee
 *
 * @ORM\Table(name="add_recepee")
 * @ORM\Entity(repositoryClass="BackyBack\CookieMeetBundle\Repository\AddRecepeeRepository")
 */
class AddRecepee
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
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="plateName", type="string", length=30, nullable=false)
     */
    private $plateName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="plateCategory", type="string", length=30, nullable=false)
     */
    private $plateCategory;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="platePrice", type="integer", nullable=false)
     */
    private $platePrice;

    /**
     * @var string
     * @Assert\NotBlank()
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
     * @return AddRecepee
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
     * @return AddRecepee
     */
    public function setPlateCategory($plateCategory)
    {
        if (is_null($plateCategory)) {
            echo "La catégorie est obligatoire";
        }
        else
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
     * @return AddRecepee
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
     * @return AddRecepee
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

