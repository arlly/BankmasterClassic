<?php
namespace AppBundle\Fulcrum\Usecase;

use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Usecase\QueryUsecaseInterface;
use AppBundle\Fulcrum\Repository\RepositoryInterface;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;

class Search implements QueryUsecaseInterface
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

        return $this->repo->queryByCriteria($criteriaBuilder);
    }
}