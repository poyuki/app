<?php

declare(strict_types=1);

namespace CentraApp\Domain;

class Milestone
{
    public function __construct(
        private string $title,
        private string $description,
        private string $url,
        private string $creatorLogin,
        private string $state,
        private int $openIssueCount,
        private int $closedIssueCount,
        private string $createdAt,
        private ?string $closedAt,
        private ?string $dueDate,
    ) {
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
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
    public function getCreatorLogin(): string
    {
        return $this->creatorLogin;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return int
     */
    public function getOpenIssueCount(): int
    {
        return $this->openIssueCount;
    }

    /**
     * @return int
     */
    public function getClosedIssueCount(): int
    {
        return $this->closedIssueCount;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string|null
     */
    public function getClosedAt(): ?string
    {
        return $this->closedAt;
    }

    /**
     * @return string|null
     */
    public function getDueDate(): ?string
    {
        return $this->dueDate;
    }
}
