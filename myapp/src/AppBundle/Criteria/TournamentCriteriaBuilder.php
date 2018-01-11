<?php
namespace AppBundle\Criteria;

use Doctrine\ORM\QueryBuilder;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Doctrine\ORM\Query\Expr;
use Carbon\Carbon;

class TournamentCriteriaBuilder implements CriteriaBuilderInterface, ToQueryBuilderInterface
{
    use ParameterParserTrait;

    const DEFAULT_SORT = 'id';

    protected $query;

    public function __construct(ParameterBag $query)
    {
        $this->query = $query;
    }

    /**
     *
     * {@inheritDoc}
     * @see \PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface::build()
     */
    public function build()
    {
        return new Criteria();
    }

    public function buildToQueryBuilder(QueryBuilder $builder)
    {
        $this->buildByQuery($builder);

        $this->buildByParameter($builder);

        $this->setOrder($builder);

        $this->setOffsetAndLimit($builder);

    }

    private function buildByQuery(QueryBuilder $builder)
    {
        $values = $this->parseQueryValues();
        $composite = $this->createQueryComposite();

        if (! $values) return;

        $expr = $builder->expr();

        foreach ($values as $value) {
            $orX = [
                self::like($expr, 'main.name', $value)
            ];

            $composite->add(new Expr\Orx($orX));
        }

        $builder->andWhere($composite);
    }

    private function buildByParameter(QueryBuilder $builder)
    {
        $expr = $builder->expr();

        if ($this->query->has('startDate') && ($this->query->get('startDate') != '')) {
            $builder->andWhere(
                $expr->gte(
                    'main.startDate',
                    $expr->literal(Carbon::parse($this->query->get('startDate'))->format('Y-m-d'))
                )
            );
        }

        if ($this->query->has('endDate') && ($this->query->get('endDate') != '')) {
            $builder->andWhere(
                $expr->lte(
                    'main.endDate',
                    $expr->literal(Carbon::parse($this->query->get('endDate'))->format('Y-m-d'))
                    )
                );
        }

        if ($this->query->has('tour') && ($this->query->get('tour') != '')) {
            $builder->andWhere(
                $expr->eq(
                    'main.tour',
                    $expr->literal($this->query->get('tour'))
                    )
                );
        }

        if ($this->query->has('active') && ($this->query->get('active') != '')) {
            $builder->andWhere(
                $expr->lte(
                    'main.startDate',
                    $expr->literal($this->query->get('active'))
                )
            )->andWhere(
                $expr->gte(
                    'main.endDate',
                    $expr->literal($this->query->get('active'))
                )
            );
        }
    }


    private function setOrder(QueryBuilder $builder)
    {
        list($direction, $target) = $this->parseSort(self::DEFAULT_SORT);

        $enableFields = [
            'id' => 'main.id'
        ];

        $builder->orderBy($enableFields[$target], $direction);
    }

    private function setOffsetAndLimit(QueryBuilder $builder)
    {
        list($limit, $offset) = $this->getLimitAndOffset();

        $builder->setFirstResult($offset);

        $builder->setMaxResults($limit);
    }

    static private function like($expr, $field, $value)
    {
        return $expr->like($field, $expr->literal('%' . $value . '%'));
    }
}