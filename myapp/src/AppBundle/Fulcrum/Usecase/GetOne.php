<?php
namespace AppBundle\Fulcrum\Usecase;

use AppBundle\Fulcrum\Repository\RepositoryInterface;
use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;

class GetOne
{

    private $repo;

    public function __construct(RepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function run(EntityInterface $criteriaBuilder = null)
    {
        if (! $criteriaBuilder instanceof CriteriaBuilderInterface)
            throw new \InvalidArgumentException();

        return $this->repo->getOneByCriteria($criteriaBuilder);
    }
}