<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Github\Authenticator;

use CentraApp\Infrastructure\Github\Authenticator\Api\GithubAuthenticatorInterface;
use CentraApp\Infrastructure\Github\Authenticator\Entity\User;
use CentraApp\Infrastructure\Github\Authenticator\Exception\GithubAuthenticationException;
use League\OAuth2\Client\Provider\Github;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class GithubAuthenticator implements GithubAuthenticatorInterface
{
    private const TOKEN_KEY = 'gh-token';
    private const STATE_KEY = 'gh-state';
    private const USER_DATA_KEY = 'gh-user';

    public function __construct(
        private RequestStack $requestStack,
        private Github       $github
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getStoredToken(): string
    {
        return $this->requestStack->getSession()
                ->get(self::TOKEN_KEY) ?? throw new GithubAuthenticationException();
    }

    public function getRedirectUrl(): string
    {
        $redirectUrl = $this->github->getAuthorizationUrl();
        $this->requestStack->getSession()->set(self::STATE_KEY, $this->github->getState());

        return $redirectUrl;
    }

    public function authenticate(string $code, string $state): void
    {
        if ($this->requestStack->getSession()->get(self::STATE_KEY) !== $state) {
            throw new \Exception('invalid state');
        }
        $token = $this->github->getAccessToken('authorization_code', ['code' => $code]);
        $this->requestStack->getSession()->set(self::TOKEN_KEY, $token->getToken());
        $this->requestStack->getSession()->set(
            self::USER_DATA_KEY,
            $this->extractUserFromResourceOwner($this->github->getResourceOwner($token))
        );
    }


    /**
     * @throws GithubAuthenticationException
     */
    public function getAuthenticatedUser(): User
    {
        $user = $this->requestStack->getSession()->get(self::USER_DATA_KEY);
        if ($user instanceof User) {
            return $user;
        }

        throw new GithubAuthenticationException();
    }

    private function extractUserFromResourceOwner(ResourceOwnerInterface $resourceOwner): User
    {
        $resourceOwnerArray = $resourceOwner->toArray();

        return new User(
            $resourceOwnerArray['name'] ?? 'unknown',
            $resourceOwnerArray['avatar_url'] ?? null,
            $resourceOwnerArray['html_url'] ?? null
        );
    }
}
