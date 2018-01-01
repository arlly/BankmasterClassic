<?php
namespace AppBundle\Criteria;

use PHPMentors\DomainKata\Entity\CriteriaInterface;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;

class IdCriteriaBuilder implements CriteriaBuilderInterface
{

    /** @var int $id */
    private $id;

    /** @var bool $excludeDeleted */
    private $excludeDeleted;

    public function __construct(int $id, $excludeDeleted = true)
    {
        $this->id = $id;
        $this->excludeDeleted = $excludeDeleted;
    }

    public function build()
    {
        $criteria = new Criteria();
        $criteria->excludeDeleted($this->excludeDeleted);

        $criteria->where($criteria->expr()->eq('id', $this->id));

        return $criteria;
    }
}