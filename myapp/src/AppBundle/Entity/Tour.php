<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use PHPMentors\DomainKata\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tour
 *
 * @ORM\Table(name="tour")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TourRepository")
 */
class Tour implements EntityInterface
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
     * @Assert\Length(max=255)
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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Tournament", mappedBy="tour")
     */
    private $tournaments;


    public function __construct()
    {
        $this->tournaments = new ArrayCollection();
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
     * @return Tour
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
     * @return Tour
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
     * @return Tour
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

    public function __toString()
    {
        return (string) $this->name;
    }

    /**
     * Add tournament.
     *
     * @param \AppBundle\Entity\Tournament $tournament
     *
     * @return Tour
     */
    public function addTournament(\AppBundle\Entity\Tournament $tournament)
    {
        $this->tournaments[] = $tournament;

        return $this;
    }

    /**
     * Remove tournament.
     *
     * @param \AppBundle\Entity\Tournament $tournament
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTournament(\AppBundle\Entity\Tournament $tournament)
    {
        return $this->tournaments->removeElement($tournament);
    }

    /**
     * Get tournaments.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTournaments()
    {
        return $this->tournaments;
    }
}
