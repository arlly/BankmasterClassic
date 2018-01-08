<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class SettingsController extends Controller
{

    /**
     * @Route("/settings/login", name="settings-login")
     * @Method({"GET", "POST"})
     */
    public function loginAction()
    {
        $user = $this->getUser();

        if ($user instanceof UserInterface) return $this->redirectToRoute('initialize');

        $utils = $this->get('security.authentication_utils');
        $exception = $utils->getLastAuthenticationError();
        $lastName  = $utils->getLastUsername();

        $data = [
            'lastName' => $lastName,
        ];

        if ($exception) {
            $this->addFlash('notice', $exception->getMessage());
        } else {
            $this->addFlash('message', 'please login');
        }

        return $this->render('auth/login.html.twig', $data);
    }

    /**
     * @Route("/settings/test", name="settings-test")
     * @Method({"GET", "POST"})
     */
    public function testAction()
    {
        dump($this->getUser());
        exit();

    }
}
