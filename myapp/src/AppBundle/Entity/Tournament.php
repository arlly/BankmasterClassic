<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use PHPMentors\DomainKata\Entity\EntityInterface;

/**
 * Tournament
 *
 * @ORM\Table(name="tournament")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TournamentRepository")
 */
class Tournament implements EntityInterface
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date")
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="date")
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $endDate;


    /**
     * @ORM\ManyToOne(targetEntity="Tour", inversedBy="tour")
     * @ORM\JoinColumn(name="tour_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $tour;

    /**
     * @ORM\OneToMany(targetEntity="Livewell", mappedBy="tournament")
     */
    private $livewells;

    public function __construct()
    {
        $this->livewells = new ArrayCollection();
    }


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
     * Set name
     *
     * @param string $name
     *
     * @return Tournament
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
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Tournament
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Tournament
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set tour
     *
     * @param \AppBundle\Entity\Tour $tour
     *
     * @return Tournament
     */
    public function setTour(\AppBundle\Entity\Tour $tour = null)
    {
        $this->tour = $tour;

        return $this;
    }

    /**
     * Get tour
     *
     * @return \AppBundle\Entity\Tour
     */
    public function getTour()
    {
        return $this->tour;
    }

    public function __toString()
    {
        return (string) $this->name;
    }

    /**
     * Add livewell.
     *
     * @param \AppBundle\Entity\Livewell $livewell
     *
     * @return Tournament
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
