<?php

declare(strict_types=1);

namespace CentraApp\Application\Query\FetchMilestones;

use CentraApp\Domain\Milestone;
use CentraApp\Domain\Spi\MilestoneRepositoryInterface;

class FetchMilestonesService implements Api\FetchMilestonesServiceInterface
{
    public function __construct(private MilestoneRepositoryInterface $milestoneRepository)
    {
    }

    /**
     * @return array<Milestone>
     */
    public function execute(string $userName, string $repoName): array
    {
        return $this->milestoneRepository->getAll($userName, $repoName);
    }
}
