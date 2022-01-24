<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Github\Repository\Milestone;

use CentraApp\Domain\Spi\MilestoneRepositoryInterface;
use Github\Client;

class MilestoneRepository implements MilestoneRepositoryInterface
{

    public function __construct(
        private Client                $client,
        private MilestoneEntityMapper $milestoneEntityMapper
    ) {
    }

    public function getAll(string $userName, string $repoName): array
    {
        $milestones = $this->client->repositories()->milestones($userName, $repoName, ['state' => 'all']);

        return array_map($this->milestoneEntityMapper, $milestones);
    }
}
