<?php

namespace AppBundle\Controller\Mypage;

use AppBundle\Controller\PaginatorTrait;
use AppBundle\Criteria\IdCriteriaBuilder;
use AppBundle\Entity\Livewell;
use AppBundle\Form\LivewellType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;


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

    /**
     * @method ("POST")
     * @Route("/livewell/add/{id}")
     */
    public function addPostAction(int $id, Request $request)
    {
        $tournament = $this->get('bankmaster.tournament.get_one')->run((new IdCriteriaBuilder($id)));

        $livewell = new Livewell();
        $form = $this->createForm(LivewellType::class, $livewell);
        $form->handleRequest($request);

        if (! $form->isValid()) return $this->render('mypage/livewell/add.html.twig', ['form' => $form->createView()]);

        $fileName1 = $this->get('bankmaster.upload_livewell_image')->run($livewell->getPhoto1());
        $fileName2 = null;
        $fileName3 = null;

        if ($livewell->getPhoto2()) $fileName2 = $this->get('bankmaster.upload_livewell_image')->run($livewell->getPhoto2());
        if ($livewell->getPhoto3()) $fileName3 = $this->get('bankmaster.upload_livewell_image')->run($livewell->getPhoto3());

        $livewell->setPhoto1($fileName1);
        $livewell->setPhoto2($fileName2);
        $livewell->setPhoto3($fileName3);
        $livewell->setTournament($tournament);
        $livewell->setUser($this->getUser());
        $livewell->setApproval(0);

        $this->get('bankmaster.livewell.create')->run($livewell);

        return $this->redirect($this->generateUrl('mypage.livewell.index'));
    }
}
