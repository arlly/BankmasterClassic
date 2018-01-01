<?php
namespace AppBundle\Controller;

use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\ParameterBag;

trait PaginatorTrait
{

    protected function getPaginatedResources(Query $query, ParameterBag $requestQuery): array
    {
        $query->setFirstResult(($requestQuery->get('page', 1)-1) * $query->getMaxResults());
        $paginator = new Paginator($query);
        $count = $paginator->count();
        $limit = $requestQuery->get('limit', $query->getMaxResults());
        return [
            'maxPage' => ceil($count / $limit),
            'count' => $count,
            'page' => $requestQuery->get('page', 1),
            'limit' => $limit,
            'resources' => $paginator->getIterator()->getArrayCopy()
        ];
    }
}
