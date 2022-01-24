<?php

declare(strict_types=1);

namespace CentraApp\Domain\Spi;

use CentraApp\Domain\Repo;

interface RepoRepositoryInterface
{
    /**
     * @return array<Repo>
     */
    public function getAll(string $userName):array;
}
