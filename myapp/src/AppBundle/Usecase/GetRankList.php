<?php
/**
 * Created by PhpStorm.
 * User: arlly
 * Date: 2018/01/18
 * Time: 20:36
 */

namespace AppBundle\Usecase;


use AppBundle\Criteria\IdCriteriaBuilder;
use AppBundle\Repository\LivewellRepository;
use AppBundle\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;

class GetRankList
{
    private $livewellRepo;
    private $userRepo;

    public function __construct(LivewellRepository $livewellRepo, UserRepository $userRepo)
    {
        $this->livewellRepo = $livewellRepo;
        $this->userRepo = $userRepo;
    }

    public function run(CriteriaBuilderInterface $criteriaBuilder)
    {
        $rankList = new ArrayCollection();
        $rankCollection = $this->livewellRepo->getRankList($criteriaBuilder);

        foreach ($rankCollection->toArray() as $rank) {
            $user = $this->userRepo->getOneByCriteria(new IdCriteriaBuilder($rank['userId'], false));
            $user->setTotalScore($rank['totalScore']);
            $rankList->add($user);
        }

        return $rankList;
    }
}