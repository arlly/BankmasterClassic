<?php

namespace AppBundle\Controller\Mypage;

use AppBundle\Criteria\TournamentCriteriaBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Controller\PaginatorTrait;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/mypage")
 */
class DashboardController extends Controller
{
    use PaginatorTrait;

    /**
     *
     * @method ("GET")
     * @Route("/index", name="mypage.index")
     */
    public function indexAction()
    {
        // アクティブなトーナメントを表示する
        $tournamentList = $this->get('bankmaster.tournament_repository')->getActiveTournament();

        return $this->render('mypage/index.html.twig', ['tournamentList' => $tournamentList]);
    }

}
