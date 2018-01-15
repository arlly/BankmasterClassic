<?php

namespace AppBundle\Repository;

use AppBundle\Criteria\ToQueryBuilderInterface;
use AppBundle\Fulcrum\Repository\RepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;

/**
 * LivewellRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LivewellRepository extends EntityRepository implements RepositoryInterface
{

    /**
     * @param EntityInterface $entity
     */
    public function add(EntityInterface $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function queryByCriteria(CriteriaBuilderInterface $criteriaBuilder)
    {
        $queryBuilder = $this->createQueryBuilder('main');

        if ($criteriaBuilder instanceof ToQueryBuilderInterface) {
            $criteriaBuilder->buildToQueryBuilder($queryBuilder);
            return $queryBuilder->getQuery();
        } else {
            return $queryBuilder->addCriteria($criteriaBuilder->build())->getQuery();
        }
    }

    public function getOneByCriteria(CriteriaBuilderInterface $criteriaBuilder)
    {
        $query = $this->queryByCriteria($criteriaBuilder);
        return $query->getOneOrNullResult();
    }

    public function update(EntityInterface $entity)
    {
        $this->getEntityManager()->merge($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param EntityInterface $entity
     */
    public function remove(EntityInterface $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}
