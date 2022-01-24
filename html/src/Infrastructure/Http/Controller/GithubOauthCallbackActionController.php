<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Http\Controller;

use CentraApp\Infrastructure\Github\Authenticator\Api\GithubAuthenticatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GithubOauthCallbackActionController extends AbstractController
{
    public function __construct(private GithubAuthenticatorInterface $githubAuthenticator)
    {
    }

    #[Route('/gh-oauth-callback', 'gh_oauth_callback')]
    public function __invoke(Request $request): Response
    {
        $this->githubAuthenticator->authenticate($request->query->get('code'),$request->query->get('state'));
        return $this->redirectToRoute('index');
    }
}
