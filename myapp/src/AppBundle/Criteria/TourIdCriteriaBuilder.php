<?php
namespace AppBundle\Criteria;

use PHPMentors\DomainKata\Entity\CriteriaInterface;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;

class TourIdCriteriaBuilder implements CriteriaBuilderInterface
{

    /** @var int $tourId */
    private $tourId;

    /** @var bool $excludeDeleted */
    private $excludeDeleted;

    public function __construct(int $tourId, $excludeDeleted = true)
    {
        $this->tourId = $tourId;
        $this->excludeDeleted = $excludeDeleted;
    }

    public function build()
    {
        $criteria = new Criteria();
        $criteria->excludeDeleted($this->excludeDeleted);

        $criteria->where($criteria->expr()->eq('tour', $this->tourId));

        return $criteria;
    }
}