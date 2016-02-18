<?php

namespace BackyBack\CookieMeetBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Hautelook\AliceBundle\Alice;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Ivory\GoogleMap\Places\Autocomplete;
use Ivory\GoogleMap\Places\AutocompleteComponentRestriction;
use Ivory\GoogleMap\Helper\Places\AutocompleteHelper;
use Ivory\GoogleMap\Places\AutocompleteType;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="BackyBack\CookieMeetBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Please enter your firstname.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     * @ORM\Column(name="firstname", type="string", length=20, nullable=true)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     * @ORM\Column(name="name", type="string", length=20, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Please enter your address.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    protected $address;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        /*$address = new Autocomplete();

        $address->setPrefixJavascriptVariable('place_autocomplete_');
        $address->setInputId('place_input');

        $address->setInputAttributes(array('class' => 'my-class'));
        $address->setInputAttribute('class', 'my-class');

        /*$autocomplete->setTypes(array(AutocompleteType::ESTABLISHMENT));*/
        /*$address->setComponentRestrictions(array(AutocompleteComponentRestriction::COUNTRY => 'fr'));

        $address->setLanguage('fr');*/

        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        /*$address = $this->setAddress($this);
        $autocomplete = $this->AutoCompleteAction();
        $autocompleteHelper = new AutocompleteHelper();
        echo $autocompleteHelper->renderHtmlContainer($autocomplete);
        echo $autocompleteHelper->renderJavascripts($autocomplete);

        return $autocomplete;*/
        return $this->address;
    }
}
