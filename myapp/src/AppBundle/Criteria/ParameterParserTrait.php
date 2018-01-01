<?php
namespace AppBundle\Criteria;

use Doctrine\ORM\Query\Expr;

trait ParameterParserTrait
{
    protected function parseQueryValues()
    {
        $queryString = $this->query->get('q');
        //$queryString = $this->query->get('form')['q'];

        if (! $queryString) return [];

        if (strpos($queryString, ' ') !== false) {
            return explode(' ', $queryString);
        } elseif (strpos($queryString, '|') !== false) {
            return explode('|', $queryString);
        }

        return [$queryString];
    }

    protected function createQueryComposite()
    {
        $queryString = $this->query->get('q');
        //$queryString = $this->query->get('form')['q'];

        if (! $queryString) return null;

        return strpos($queryString, '|') === false
        ? new Expr\Andx()
        : new Expr\Orx();
    }

    protected function parseSort($default)
    {
        $sort = $this->query->get('sort', $default);

        $direction = substr($sort, 0, 1) == '-' ? 'DESC' : 'ASC';
        $target = substr($sort, 0, 1) == '-' ? substr($sort, 1) : $sort;

        return [$direction, $target];
    }

    protected function getLimitAndOffset()
    {
        $limit = $this->query->get('limit', 20);
        $offset = ($this->query->get('page', 1) - 1) * $limit;

        return [$limit, $offset];
    }
}