<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Controller\PaginatorTrait;


/**
 * @Route("/admin")
 */
class DashboardController extends Controller
{
    use PaginatorTrait;


    /**
     *
     * @method ("GET")
     * @Route("/index", name="admin.index")
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig');

    }

}
