<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Github;

use CentraApp\Infrastructure\Github\Authenticator\Api\GithubAuthenticatorInterface;
use Github\AuthMethod;
use Github\Client;
use Github\HttpClient\Builder;
use Psr\Cache\CacheItemPoolInterface;

class GithubClientFactory
{
    public function __construct(
        private Builder $builder,
        private CacheItemPoolInterface $cacheItemPool,
        private GithubAuthenticatorInterface $githubAuthenticator
    ) {
    }

    public function __invoke(): Client
    {
        $client = new Client($this->builder);
        $client->addCache($this->cacheItemPool);
        $client->authenticate($this->githubAuthenticator->getStoredToken(), authMethod: AuthMethod::ACCESS_TOKEN);

        return $client;
    }
}
