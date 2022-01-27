<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Http\Controller;

use CentraApp\Application\Query\FetchMilestones\Api\FetchMilestonesServiceInterface;
use CentraApp\Infrastructure\Github\Authenticator\Api\GithubAuthenticatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class FetchRepoMilestonesActionController extends AbstractController
{
    public function __construct(
        private GithubAuthenticatorInterface    $githubAuthenticator,
        private FetchMilestonesServiceInterface $fetchMilestonesService
    ) {
    }

    #[Route('/{repoName}/milestones', 'repo-milestones', methods: 'GET')]
    public function __invoke(string $repoName): Response
    {
        $user = $this->githubAuthenticator->getAuthenticatedUser();
        $milestones = $this->fetchMilestonesService->execute($user->getName(), $repoName);
        return new Response(
            $this->renderView('milestones.html.twig', [
                'milestones' => $milestones
            ])
        );
    }
}
