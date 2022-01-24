<?php

declare(strict_types=1);

namespace CentraApp\Domain;

class Repo
{
    public function __construct(
        private string $name,
        private string $url,
        private string $visibility,
        private bool   $isPrivate,
        private string $ownerLogin,
    ) {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getVisibility(): string
    {
        return $this->visibility;
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this->isPrivate;
    }

    /**
     * @return string
     */
    public function getOwnerLogin(): string
    {
        return $this->ownerLogin;
    }


}
