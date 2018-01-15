<?php
namespace AppBundle\Criteria;

use Doctrine\ORM\QueryBuilder;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Doctrine\ORM\Query\Expr;
use Carbon\Carbon;

class LivewellCriteriaBuilder implements CriteriaBuilderInterface, ToQueryBuilderInterface
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

        if ($this->query->has('tournament') && ($this->query->get('tournament') != '')) {
            $builder->andWhere(
                $expr->eq(
                    'main.tournament',
                    $expr->literal($this->query->get('tournament'))
                )
            );
        }

        if ($this->query->has('user') && ($this->query->get('user') != '')) {
            $builder->andWhere(
                $expr->eq(
                    'main.user',
                    $expr->literal($this->query->get('user'))
                    )
                );
        }

        if ($this->query->has('approval') && ($this->query->get('approval') != '')) {
            $builder->andWhere(
                $expr->eq(
                    'main.approval',
                    $expr->literal($this->query->get('approval'))
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