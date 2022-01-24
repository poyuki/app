<?php

declare(strict_types=1);

namespace CentraApp\Application\Query\FetchMilestones\Api;

use CentraApp\Domain\Milestone;

interface FetchMilestonesServiceInterface
{
    /**
     * @return array<Milestone>
     */
    public function execute(string $userName, string $repoName): array;
}
