<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Github\Authenticator\Entity;

use CentraApp\Infrastructure\Github\Exception\InvalidEntityProvidedException;

class User implements \JsonSerializable
{
    protected const FIELD_NAME = 'name';
    protected const FIELD_AVATAR_URL = 'avatarUrl';
    protected const FIELD_GITHUB_URL = 'githubUrl';

    public function __construct(
        private string $name,
        private ?string $avatarUrl = null,
        private ?string $githubUrl = null
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAvatarUrl(): ?string
    {
        return $this->avatarUrl;
    }

    public function getGithubUrl(): ?string
    {
        return $this->githubUrl;
    }

    public function jsonSerialize(): array
    {
        return [
            self::FIELD_NAME => $this->getName(),
            self::FIELD_AVATAR_URL => $this->getAvatarUrl(),
            self::FIELD_GITHUB_URL => $this->getGithubUrl()
        ];
    }

    /**
     * @throws \JsonException
     */
    public static function jsonDeserialize(string $jsonSerializedEntity): static
    {
        $jsonDecoded = \json_decode($jsonSerializedEntity, true, 512, JSON_THROW_ON_ERROR);
        return new static(
            $jsonDecoded[self::FIELD_NAME] ?? throw new InvalidEntityProvidedException(
                sprintf(InvalidEntityProvidedException::MESSAGE_TEMPLATE, self::FIELD_NAME)
            ),
            $jsonDecoded[self::FIELD_AVATAR_URL] ?? throw new InvalidEntityProvidedException(
                sprintf(InvalidEntityProvidedException::MESSAGE_TEMPLATE, self::FIELD_AVATAR_URL)
            ),
            $jsonDecoded[self::FIELD_GITHUB_URL] ?? throw new InvalidEntityProvidedException(
                sprintf(InvalidEntityProvidedException::MESSAGE_TEMPLATE, self::FIELD_GITHUB_URL)
            )
        );
    }
}
