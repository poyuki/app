<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Http\Controller;

use CentraApp\Infrastructure\Github\Authenticator\Api\GithubAuthenticatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuthenticationInitActionController extends AbstractController
{
    public function __construct(private GithubAuthenticatorInterface $githubAuthenticator)
    {
    }

    #[Route('/login', 'login')]
    public function __invoke(): RedirectResponse
    {
        return new RedirectResponse($this->githubAuthenticator->getRedirectUrl());
    }
}
