<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Controller\PaginatorTrait;
use AppBundle\Form\TourType;
use AppBundle\Entity\Tour;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Criteria\IdCriteriaBuilder;


/**
 * @Route("/admin/tour")
 */
class TourController extends Controller
{
    use PaginatorTrait;


    /**
     *
     * @method ("GET")
     * @Route("/index", name="admin.tour.index")
     */
    public function indexAction()
    {
        $tourList = $this->get('bankmaster.tour_repository')->findAll();
        return $this->render('admin/tour/index.html.twig', ['tourList' => $tourList]);
    }


    /**
     * @method ("POST")
     * @Route("/add")
     */
    public function addPostAction(Request $request)
    {
        $form = $this->createForm(TourType::class, new Tour());
        $form->handleRequest($request);

        if (! $form->isValid()) return $this->render('admin/tour/edit.html.twig', ['form' => $form->createView()]);

        $tour = $form->getData();
        $this->get('bankmaster.tour.create')->run($tour);

        return $this->redirect($this->generateUrl('admin.tour.index'));

    }

    /**
     *
     * @method ("GET")
     * @Route("/add", name="admin.tour.add")
     */
    public function addAction()
    {
        $form = $this->createForm(TourType::class, new Tour());
        return $this->render('admin/tour/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @method ("POST")
     * @Route("/update/{id}")
     */
    public function updatePostAction(int $id, Request $request)
    {
        $tour = $this->get('bankmaster.tour.get_one')->run(new IdCriteriaBuilder($id, false));
        $form = $this->createForm(TourType::class, $tour);
        $form->handleRequest($request);

        if (! $form->isValid()) return $this->render('admin/tour/edit.html.twig', ['form' => $form->createView()]);

        $this->get('bankmaster.tour.update')->run($tour);

        return $this->redirect($this->generateUrl('admin.tour.index'));
    }


    /**
     *
     * @method ("GET")
     * @Route("/update/{id}", name="admin.tour.update")
     */
    public function updateAction(int $id)
    {
        $tour = $this->get('bankmaster.tour.get_one')->run(new IdCriteriaBuilder($id, false));
        $form = $this->createForm(TourType::class, $tour);
        return $this->render('admin/tour/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @method ("GET")
     * @Route("/remove/{id}", name="admin.tour.remove")
     */
    public function removeAction(int $id)
    {
        $tour = $this->get('bankmaster.tour.get_one')->run(new IdCriteriaBuilder($id, false));
        $this->get('bankmaster.tour.remove')->run($tour);

        return $this->redirect($this->generateUrl('admin.tour.index'));
    }

}
