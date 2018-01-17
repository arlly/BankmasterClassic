<?php
/**
 * Created by PhpStorm.
 * User: arlly
 * Date: 2018/01/17
 * Time: 13:30
 */

namespace AppBundle\Usecase;

use AppBundle\Repository\LivewellRepository;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;

class GetPersonalScore
{
    private $repo;

    public function __construct(LivewellRepository $repo)
    {
        $this->repo = $repo;
    }

    public function run(CriteriaBuilderInterface $criteriaBuilder)
    {
        $score = 0;
        $query = $this->repo->queryByCriteria($criteriaBuilder);
        $livewells = $query->getResult();

        foreach ($livewells as $livewll) {
            $score += $livewll->getSize();
        }

        return $score;
    }
}