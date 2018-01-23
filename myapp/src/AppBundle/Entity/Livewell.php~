<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PHPMentors\DomainKata\Entity\EntityInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Livewell
 *
 * @ORM\Table(name="livewell")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LivewellRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Livewell implements EntityInterface
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
     * @ORM\Column(name="field", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $field;

    /**
     * @var string
     *
     * @ORM\Column(name="photo1", type="string", length=255)
     * @Assert\Image()
     */
    private $photo1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo2", type="string", length=255, nullable=true)
     * @Assert\Image()
     */
    private $photo2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo3", type="string", length=255, nullable=true)
     * @Assert\Image()
     */
    private $photo3;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="decimal", precision=10, scale=2)
     * @Assert\Range(
     *      min = 30,
     *      max = 80,
     * )
     */
    private $size;

    /**
     * @var int
     *
     * @ORM\Column(name="approval", type="integer", options={"default" : 0})
     * @Assert\NotBlank(groups={"admin"})
     */
    private $approval;


    /**
     * @ORM\ManyToOne(targetEntity="Tournament", inversedBy="tournament")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
     */
    private $tournament;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="livewells")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;
    
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set photo1.
     *
     * @param string $photo1
     *
     * @return Livewell
     */
    public function setPhoto1($photo1)
    {
        $this->photo1 = $photo1;

        return $this;
    }

    /**
     * Get photo1.
     *
     * @return string
     */
    public function getPhoto1()
    {
        return $this->photo1;
    }

    /**
     * Set photo2.
     *
     * @param string|null $photo2
     *
     * @return Livewell
     */
    public function setPhoto2($photo2 = null)
    {
        $this->photo2 = $photo2;

        return $this;
    }

    /**
     * Get photo2.
     *
     * @return string|null
     */
    public function getPhoto2()
    {
        return $this->photo2;
    }

    /**
     * Set photo3.
     *
     * @param string|null $photo3
     *
     * @return Livewell
     */
    public function setPhoto3($photo3 = null)
    {
        $this->photo3 = $photo3;

        return $this;
    }

    /**
     * Get photo3.
     *
     * @return string|null
     */
    public function getPhoto3()
    {
        return $this->photo3;
    }

    /**
     * Set size.
     *
     * @param string $size
     *
     * @return Livewell
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size.
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set approval.
     *
     * @param int $approval
     *
     * @return Livewell
     */
    public function setApproval($approval)
    {
        $this->approval = $approval;

        return $this;
    }

    /**
     * Get approval.
     *
     * @return int
     */
    public function getApproval()
    {
        return $this->approval;
    }

    /**
     * Set tournament.
     *
     * @param \AppBundle\Entity\Tournament|null $tournament
     *
     * @return Livewell
     */
    public function setTournament(\AppBundle\Entity\Tournament $tournament = null)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament.
     *
     * @return \AppBundle\Entity\Tournament|null
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * Set user.
     *
     * @param \AppBundle\Entity\User|null $user
     *
     * @return Livewell
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set field.
     *
     * @param string $field
     *
     * @return Livewell
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field.
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Livewell
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Livewell
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Gets triggered only on insert

     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime("now");
    }

    /**
     * Gets triggered every time on update

     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime("now");
    }
}
