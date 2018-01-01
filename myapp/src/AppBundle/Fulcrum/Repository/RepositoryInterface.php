<?php
namespace AppBundle\Fulcrum\Repository;

use PHPMentors\DomainKata\Repository\RepositoryInterface as BaseRepositoryInterface;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;
use PHPMentors\DomainKata\Entity\EntityInterface;

interface RepositoryInterface extends BaseRepositoryInterface
{
    public function queryByCriteria(CriteriaBuilderInterface $criteriaBuilder);

    public function getOneByCriteria(CriteriaBuilderInterface $criteriaBuilder);

    public function update(EntityInterface $entity);

}