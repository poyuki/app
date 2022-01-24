<?php

declare(strict_types=1);

namespace CentraApp\Application\Query\FetchRepo\Api;

interface FetchRepoServiceInterface
{
    public function execute(string $userName):array;
}
