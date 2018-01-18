<?php
/**
 * Created by PhpStorm.
 * User: arlly
 * Date: 2018/01/18
 * Time: 9:19
 */

namespace AppBundle\Usecase;

use AppBundle\Repository\LivewellRepository;

class ReplaceLivewell
{
    private $repo;
    private $limitNumber;

    public function __construct(LivewellRepository $repo, int $limitNumber)
    {
        $this->repo = $repo;
        $this->limitNumber = $limitNumber;
    }

    public function run(int $userId, int $tournamentId)
    {
        $results = $this->repo->getPersonalLivewell($userId, $tournamentId);

        if (count($results) <= $this->limitNumber) return false;

        $num = 0;
        foreach($results as $livewell) {
            $num++;

            if ($num <= $this->limitNumber) continue;

            $livewell->setApproval(0);
            $this->repo->update($livewell);
        }
    }
}