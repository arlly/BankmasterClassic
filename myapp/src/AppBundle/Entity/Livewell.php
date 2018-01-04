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
     * @ORM\Column(name="photo1", type="string", length=255)
     */
    private $photo1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo2", type="string", length=255, nullable=true)
     */
    private $photo2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo3", type="string", length=255, nullable=true)
     */
    private $photo3;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="decimal", precision=10, scale=2)
     */
    private $size;

    /**
     * @var int
     *
     * @ORM\Column(name="approval", type="integer")
     * @Assert\NotBlank()
     */
    private $approval;


    /**
     * @ORM\ManyToOne(targetEntity="Tournament", inversedBy="tournament")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $tournament;



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
}
