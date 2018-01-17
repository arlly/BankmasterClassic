<?php
namespace Tests\AppBundle\Controller;

use AppBundle\Criteria\PersonalScoreOnTournamentCriteriaBuilder;
use AppBundle\Repository\LivewellRepository;
use AppBundle\Usecase\GetPersonalScore;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: arlly
 * Date: 2018/01/17
 * Time: 13:35
 */

class GetPersonalScoreTest extends TestCase
{
    public function testPersonalScore()
    {

        $mock = \Phake::mock(LivewellRepository::class);

        $usecase = new GetPersonalScore($mock);
        $this->assertNotNull($usecase->run(new PersonalScoreOnTournamentCriteriaBuilder(2,1,1)));


    }
}