<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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

    const ADMIN = 'ROLE_ADMIN';
    const STAFF = 'ROLE_STAFF';
    const USER = 'ROLE_USER';

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


    protected $totalScore;

    /**
     * @ORM\OneToMany(targetEntity="Livewell", mappedBy="user")
     */
    protected $livewells;



    public function __construct()
    {
        parent::__construct();

        $this->roles = [self::USER];
        $this->livewells = new ArrayCollection();
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

    public function setTotalScore($totalScore)
    {
        $this->totalScore = $totalScore;

        return $this;
    }

    public function getTotalScore()
    {
        return $this->totalScore;
    }


    /**
     * Add livewell.
     *
     * @param \AppBundle\Entity\Livewell $livewell
     *
     * @return User
     */
    public function addLivewell(\AppBundle\Entity\Livewell $livewell)
    {
        $this->livewells[] = $livewell;

        return $this;
    }

    /**
     * Remove livewell.
     *
     * @param \AppBundle\Entity\Livewell $livewell
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeLivewell(\AppBundle\Entity\Livewell $livewell)
    {
        return $this->livewells->removeElement($livewell);
    }

    /**
     * Get livewells.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLivewells()
    {
        return $this->livewells;
    }
}
