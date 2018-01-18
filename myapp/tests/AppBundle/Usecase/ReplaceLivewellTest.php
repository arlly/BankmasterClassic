<?php
/**
 * Created by PhpStorm.
 * User: arlly
 * Date: 2018/01/18
 * Time: 9:22
 */

namespace Tests\AppBundle\Usecase;

use AppBundle\Repository\LivewellRepository;
use AppBundle\Usecase\ReplaceLivewell;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class ReplaceLivewellTest extends TestCase
{
    /**
     * @test
     */
    public function 入れ替えが必要ないテスト()
    {
        $arrayCollection = new ArrayCollection([1 => 'Arimoto', 2 => 'Fuminori', 3=> 'Test']);
        $mock = \Phake::mock(LivewellRepository::class);
        \Phake::when($mock)->getLivewellCount($arrayCollection);

        $usecase = new ReplaceLivewell($mock, 3);
        $this->assertFalse($usecase->run(1, 2));
    }
}