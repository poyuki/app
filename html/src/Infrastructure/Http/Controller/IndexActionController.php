<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Http\Controller;

use CentraApp\Application\Query\FetchRepo\Api\FetchRepoServiceInterface;
use CentraApp\Infrastructure\Github\Authenticator\Api\GithubAuthenticatorInterface;
use CentraApp\Infrastructure\Github\Authenticator\Exception\GithubAuthenticationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class IndexActionController extends AbstractController
{
    public function __construct(
        private GithubAuthenticatorInterface $githubAuthenticator,
        private FetchRepoServiceInterface $fetchRepoService
    ) {
    }

    /**
     * @throws GithubAuthenticationException
     */
    #[Route('/', 'index',methods: 'GET')]
    public function __invoke(): Response
    {
        $user = $this->githubAuthenticator->getAuthenticatedUser();
        $repositories = $this->fetchRepoService->execute($user->getName());

        return $this->render('index.html.twig', ['user' => $user, 'repositories' => $repositories]);
    }
}
