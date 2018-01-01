<?php

namespace AppBundle\Criteria;

use Doctrine\ORM\QueryBuilder;

interface ToQueryBuilderInterface
{
    public function buildToQueryBuilder(QueryBuilder $builder);
}
