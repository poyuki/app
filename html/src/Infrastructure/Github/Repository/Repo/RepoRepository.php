<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Github\Repository\Repo;

use CentraApp\Domain\Spi\RepoRepositoryInterface;
use Github\Client;

class RepoRepository implements RepoRepositoryInterface
{
    public function __construct(
        private Client           $client,
        private RepoEntityMapper $repoEntityMapper
    ) {
    }

    public function getAll(string $userName): array
    {
        $repositories = $this->client->user()->repositories($userName);

        return array_map($this->repoEntityMapper, $repositories);
    }
}
