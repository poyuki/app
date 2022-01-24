<?php

declare(strict_types=1);

namespace CentraApp\Application\Query\FetchRepo;

use CentraApp\Application\Query\FetchRepo\Api\FetchRepoServiceInterface;
use CentraApp\Domain\Spi\RepoRepositoryInterface;

class FetchRepoService implements FetchRepoServiceInterface
{
    public function __construct(private RepoRepositoryInterface $repoRepository)
    {
    }

    public function execute(string $userName): array
    {
        //in this place can be a layer of data transformation
        return $this->repoRepository->getAll($userName);
    }
}
