<?php

namespace AppBundle\Controller\Mypage;

use AppBundle\Controller\PaginatorTrait;
use AppBundle\Criteria\PersonalScoreOnTourCriteriaBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


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
        $criteria = new PersonalScoreOnTourCriteriaBuilder(1, $this->getUser()->getId());
        $totalScore = $this->get('bankmaster.get_personal_score')->run($criteria);

        // アクティブなトーナメントを表示する
        $tournamentList = $this->get('bankmaster.tournament_repository')->getActiveTournament();
        return $this->render('mypage/index.html.twig', [
            'tournamentList' => $tournamentList,
            'totalScore' => $totalScore
        ]);
    }

}
