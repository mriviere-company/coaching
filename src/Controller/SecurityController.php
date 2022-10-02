<?php

namespace App\Controller;

use App\Security\UserAuthenticator;
use Doctrine\Persistence\ManagerRegistry;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class SecurityController extends AbstractController
{
    private ManagerRegistry $doctrine;
    private UserAuthenticatorInterface $userAuthenticator;
    private UserAuthenticator $authenticator;
    private TranslatorInterface $translator;

    public function __construct(ManagerRegistry $doctrine, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, TranslatorInterface $translator)
    {
        $this->doctrine = $doctrine;
        $this->userAuthenticator = $userAuthenticator;
        $this->authenticator = $authenticator;
        $this->translator = $translator;
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(): Response|RedirectResponse
    {
        if ($this->getUser())
            return $this->redirectToRoute('dashboard');
        else
            return $this->render('admin/admin.html.twig');
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
