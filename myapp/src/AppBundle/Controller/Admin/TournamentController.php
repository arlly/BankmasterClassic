<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Controller\PaginatorTrait;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Criteria\IdCriteriaBuilder;
use AppBundle\Form\TournamentType;
use AppBundle\Entity\Tournament;


/**
 * @Route("/admin/tournament")
 */
class TournamentController extends Controller
{
    use PaginatorTrait;


    /**
     *
     * @Method ("GET")
     * @Route("/index", name="admin.tournament.index")
     */
    public function indexAction()
    {
        $tournamentList = $this->get('bankmaster.tournament_repository')->findAll();
        return $this->render('admin/tournament/index.html.twig', ['tournamentList' => $tournamentList]);
    }

    /**
     *
     * @Method ("POST")
     * @Route("/add")
     */
    public function addPostAction(Request $request)
    {
        $form = $this->createForm(TournamentType::class, new Tournament());
        $form->handleRequest($request);

        if (! $form->isValid()) return $this->render('admin/tournament/edit.html.twig', ['form' => $form->createView()]);

        $tour = $form->getData();
        $this->get('bankmaster.tournament.create')->run($tour);

        return $this->redirect($this->generateUrl('admin.tournament.index'));

    }

    /**
     *
     * @Method ("GET")
     * @Route("/add", name="admin.tournament.add")
     */
    public function addAction()
    {
        $form = $this->createForm(TournamentType::class, new Tournament());
        return $this->render('admin/tournament/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Method ("POST")
     * @Route("/update/{id}")
     */
    public function updatePostAction(int $id, Request $request)
    {
        $tournament = $this->get('bankmaster.tournament.get_one')->run(new IdCriteriaBuilder($id, false));
        $form = $this->createForm(TournamentType::class, $tournament);
        $form->handleRequest($request);

        if (! $form->isValid()) return $this->render('admin/tournament/edit.html.twig', ['form' => $form->createView()]);

        $this->get('bankmaster.tournament.update')->run($tournament);

        return $this->redirect($this->generateUrl('admin.tournament.index'));
    }


    /**
     *
     * @Method ("GET")
     * @Route("/update/{id}", name="admin.tournament.update")
     */
    public function updateAction(int $id)
    {
        $tournament = $this->get('bankmaster.tournament.get_one')->run(new IdCriteriaBuilder($id, false));
        $form = $this->createForm(TournamentType::class, $tournament);
        return $this->render('admin/tournament/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Method ("GET")
     * @Route("/remove/{id}", name="admin.tournament.remove")
     */
    public function removeAction(int $id)
    {
        $tournament = $this->get('bankmaster.tournament.get_one')->run(new IdCriteriaBuilder($id, false));
        $this->get('bankmaster.tournament.remove')->run($tournament);

        return $this->redirect($this->generateUrl('admin.tournament.index'));
    }

}
