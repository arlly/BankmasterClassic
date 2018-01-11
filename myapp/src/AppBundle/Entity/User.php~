<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use PHPMentors\DomainKata\Entity\EntityInterface;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="nickname", type="string", length=255)
     * @Assert\NotBlank(groups={"Registration"})
     */
    protected $nickname;


    /**
     * @ORM\Column(name="home_ground", type="string", length=255)
     * @Assert\NotBlank(groups={"Registration"})
     */
    protected $homeGround;



    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set nickname.
     *
     * @param string $nickname
     *
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname.
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set homeGround.
     *
     * @param string $homeGround
     *
     * @return User
     */
    public function setHomeGround($homeGround)
    {
        $this->homeGround = $homeGround;

        return $this;
    }

    /**
     * Get homeGround.
     *
     * @return string
     */
    public function getHomeGround()
    {
        return $this->homeGround;
    }
}
