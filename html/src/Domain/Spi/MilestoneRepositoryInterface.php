<?php

declare(strict_types=1);

namespace CentraApp\Domain\Spi;

use CentraApp\Domain\Milestone;

interface MilestoneRepositoryInterface
{
    /**
     * @return array<Milestone>
     */
    public function getAll(string $userName, string $repoName): array;
}
