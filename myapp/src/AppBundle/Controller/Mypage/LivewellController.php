<?php

namespace AppBundle\Controller\Mypage;

use AppBundle\Controller\PaginatorTrait;
use AppBundle\Entity\Livewell;
use AppBundle\Form\LivewellType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * @Route("/mypage")
 */
class LivewellController extends Controller
{
    use PaginatorTrait;

    /**
     *
     * @method ("GET")
     * @Route("/livewell/index", name="mypage.livewell.index")
     */
    public function indexAction()
    {
        // アクティブなトーナメントを表示する
        $tournamentList = $this->get('bankmaster.tournament_repository')->getActiveTournament();
        return $this->render('mypage/index.html.twig', ['tournamentList' => $tournamentList]);
    }

    /**
     *
     * @method ("GET")
     * @Route("/livewell/add/{id}", name="mypage.livewell.add")
     */
    public function addAction(int $id)
    {
        $form = $this->createForm(LivewellType::class, new Livewell());
        return $this->render('mypage/livewell/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
