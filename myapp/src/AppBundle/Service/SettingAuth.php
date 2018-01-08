<?php
namespace AppBundle\Service;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class SettingAuth extends AbstractGuardAuthenticator
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var string
     */
    private $message = 'please check inputs. ';

    /**
     * SettingAuth constructor.
     *
     * @param $em
     * @param $router
     */
    public function __construct($em, $router)
    {
        $this->em = $em;
        $this->router = $router;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        $url = $this->router->generate('settings-login');
        return new RedirectResponse($url);
    }

    public function getCredentials(Request $request)
    {
        $url = $this->router->generate('settings-login');

        if ($request->getPathInfo() != $url || $request->getMethod() !== 'POST') {
            return null;
        }

        $username = $request->request->get('_username');
        $request->getSession()->set(Security::LAST_USERNAME, $username);

        return array(
            'username' => $username,
            'password' => $request->request->get('_password'),
        );
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if (!isset($credentials['username'])) {
            return null;
        }

        $username = $credentials['username'];

        $user = $this->em->getRepository(User::class)->findOneBy(['username' => $username]);

        if (! $user) throw new CustomUserMessageAuthenticationException($this->message);

        return $user;

    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['password'];
        if (password_verify($password, $user->getPassword())) {
            return true;
        }

        throw new CustomUserMessageAuthenticationException($this->message);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
        $url = $this->router->generate('settings-login');
        return new RedirectResponse($url);
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $url = $this->router->generate('initialize');
        return new RedirectResponse($url);
    }

    public function supportsRememberMe()
    {
        return false;
    }

}