<?php
/**
 * Created by PhpStorm.
 * User: arlly
 * Date: 2018/01/18
 * Time: 20:36
 */

namespace AppBundle\Usecase;


use AppBundle\Repository\LivewellRepository;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;

class GetRankList
{
    private $repo;

    public function __construct(LivewellRepository $repo)
    {
        $this->repo = $repo;
    }

    public function run(CriteriaBuilderInterface $criteriaBuilder)
    {
        return $this->repo->getRankList($criteriaBuilder);
    }
}