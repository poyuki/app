<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Github\Authenticator\Api;

use CentraApp\Infrastructure\Github\Authenticator\Entity\User;
use CentraApp\Infrastructure\Github\Authenticator\Exception\GithubAuthenticationException;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

interface GithubAuthenticatorInterface
{
    /**
     * @throws GithubAuthenticationException
     */
    public function getStoredToken(): string;

    public function getRedirectUrl(): string;

    public function authenticate(string $code, string $state): void;

    /**
     * @throws GithubAuthenticationException
     */
    public function getAuthenticatedUser():User;
}
