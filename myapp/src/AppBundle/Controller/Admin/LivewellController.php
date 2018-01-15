<?php
/**
 * Created by PhpStorm.
 * User: arlly
 * Date: 2018/01/15
 * Time: 13:11
 */
namespace AppBundle\Controller\Admin;

use AppBundle\Controller\PaginatorTrait;
use AppBundle\Controller\UrlParameterTrait;
use AppBundle\Criteria\IdCriteriaBuilder;
use AppBundle\Criteria\LivewellCriteriaBuilder;
use AppBundle\Form\AdminLivewellType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/livewell")
 */
class LivewellController extends Controller
{
    use PaginatorTrait;
    use UrlParameterTrait;

    /**
     *
     * @Method ("GET")
     * @Route("/index", name="admin.livewell.index")
     */
    public function indexAction(Request $request)
    {
        $query = $this->get('bankmaster.livewell.search')->run(new LivewellCriteriaBuilder($request->query));
        $livewellList = $this->getPaginatedResources($query, $request->query);

        return $this->render('admin/livewell/index.html.twig',
            [
                'livewellList' => $livewellList,
                'query' => $this->generateUrlParameter($request->query)
            ]);

    }

    /**
     *
     * @Method ("POST")
     * @Route("/index")
     */
    public function indexPostAction(Request $request)
    {

    }

    /**
     *
     * @Method ("GET")
     * @Route("/update/{id}", name="admin.livewell.update")
     */
    public function updateAction(int $id)
    {
        $livewell = $this->get('bankmaster.livewell.get_one')->run(new IdCriteriaBuilder($id, false));
        $form = $this->createForm(AdminLivewellType::class, $livewell);
        return $this->render('admin/livewell/edit.html.twig', [
            'form' => $form->createView(),
            'livewell' => $livewell
        ]);
    }

    /**
     * @Method ("POST")
     * @Route("/update/{id}")
     */
    public function updatePostAction(int $id, Request $request)
    {
        $livewell = $this->get('bankmaster.livewell.get_one')->run(new IdCriteriaBuilder($id, false));
        $form = $this->createForm(AdminLivewellType::class, $livewell);
        $form->handleRequest($request);

        if (! $form->isValid()) {
            return $this->render('admin/livewell/edit.html.twig', [
                'form' => $form->createView(),
                'livewell' => $livewell
            ]);
        }

        $this->get('bankmaster.livewell.update')->run($livewell);
        return $this->redirect($this->generateUrl('admin.livewell.index'));
    }


}