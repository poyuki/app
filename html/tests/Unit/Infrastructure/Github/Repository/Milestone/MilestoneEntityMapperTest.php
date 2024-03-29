<?php

declare(strict_types=1);

namespace CentraApp\Tests\Infrastructure\Github\Repository\Milestone;

use CentraApp\Domain\Milestone;
use CentraApp\Infrastructure\Github\Repository\Milestone\MilestoneEntityMapper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyAccess\Exception\NoSuchIndexException;

class MilestoneEntityMapperTest extends TestCase
{
    private MilestoneEntityMapper $sut;

    protected function setUp(): void
    {
        $this->sut = new MilestoneEntityMapper();
    }

    /**
     * @dataProvider getValidDataForMapping
     */
    public function testSuccessMapping(array $input, Milestone $target): void
    {
        $entity = ($this->sut)($input);
        self::assertEquals($entity->getTitle(), $target->getTitle());
        self::assertEquals($entity->getUrl(), $target->getUrl());
        self::assertEquals($entity->getState(), $target->getState());
        self::assertEquals($entity->getClosedAt(), $target->getClosedAt());
        self::assertEquals($entity->getClosedIssueCount(), $target->getClosedIssueCount());
        self::assertEquals($entity->getOpenIssueCount(), $target->getOpenIssueCount());
        self::assertEquals($entity->getDescription(), $target->getDescription());
        self::assertEquals($entity->getClosedAt(), $target->getClosedAt());
        self::assertEquals($entity->getCreatedAt(), $target->getCreatedAt());
        self::assertEquals($entity->getDueDate(), $target->getDueDate());
    }

    /**
     * @dataProvider getInvalidDataForMapping
     */
    public function testFailureMapping(array $input): void
    {
        $this->expectException(NoSuchIndexException::class);
        ($this->sut)($input);
    }

    public function getValidDataForMapping(): array
    {
        return [
            [[
                'title' => 'title',
                'description' => 'description',
                'html_url' => 'url',
                'creator' => ['login' => 'creatorLogin'],
                'state' => 'state',
                'open_issues' => 0,
                'closed_issues' => 0,
                'created_at' => 'createdAt',
                'closed_at' => 'closedAt',
                'due_on' => 'dueDate',
            ],
                new Milestone(
                    'title',
                    'description',
                    'url',
                    'creatorLogin',
                    'state',
                    0,
                    0,
                    'createdAt',
                    'closedAt',
                    'dueDate',
                )
            ],
            [[
                'title' => 'title',
                'description' => 'description',
                'html_url' => 'url',
                'creator' => ['login' => 'creatorLogin'],
                'state' => 'state',
                'open_issues' => 0,
                'closed_issues' => 0,
                'created_at' => 'createdAt',
                'closed_at' => null,
                'due_on' => null,
            ],
                new Milestone(
                    'title',
                    'description',
                    'url',
                    'creatorLogin',
                    'state',
                    0,
                    0,
                    'createdAt',
                    null,
                    null,
                )
            ],
        ];
    }


    public function getInvalidDataForMapping(): array
    {
        return [
            [[
                'title' => 'title',
                'description' => 'description',
                'html_url' => 'url',
                'creator' => ['login' => 'creatorLogin'],
                'state' => 'state',
                'open_issues' => 0,
                'closed_issues' => 0,
                'created_at' => 'createdAt',
                'due_on' => 'dueDate',
            ]],
            [[
                'title' => 'title',
                'description' => 'description',
                'html_url' => 'url',
                'creator' => ['login' => 'creatorLogin'],
                'state' => 'state',
                'open_issues' => 0,
                'closed_issues' => 0,
                'created_at' => 'createdAt',
                'closed_at' => 'closedAt',
            ]],
            [[
                'title' => 'title',
                'description' => 'description',
                'html_url' => 'url',
                'creator' => ['login' => 'creatorLogin'],
                'state' => 'state',
                'open_issues' => 0,
                'closed_issues' => 0,
                'closed_at' => 'closedAt',
                'due_on' => 'dueDate',
            ]],
            [[
                'title' => 'title',
                'description' => 'description',
                'html_url' => 'url',
                'creator' => ['login' => 'creatorLogin'],
                'state' => 'state',
                'open_issues' => 0,
                'created_at' => 'createdAt',
                'closed_at' => 'closedAt',
                'due_on' => 'dueDate',
            ]],
            [[
                'title' => 'title',
                'description' => 'description',
                'html_url' => 'url',
                'creator' => ['login' => 'creatorLogin'],
                'state' => 'state',
                'closed_issues' => 0,
                'created_at' => 'createdAt',
                'closed_at' => 'closedAt',
                'due_on' => 'dueDate',
            ]],
            [[
                'title' => 'title',
                'description' => 'description',
                'html_url' => 'url',
                'creator' => ['login' => 'creatorLogin'],
                'open_issues' => 0,
                'closed_issues' => 0,
                'created_at' => 'createdAt',
                'closed_at' => 'closedAt',
                'due_on' => 'dueDate',
            ]],
            [[
                'title' => 'title',
                'description' => 'description',
                'html_url' => 'url',
                'creator' => [],
                'state' => 'state',
                'open_issues' => 0,
                'closed_issues' => 0,
                'created_at' => 'createdAt',
                'closed_at' => 'closedAt',
                'due_on' => 'dueDate',
            ]],
            [[
                'title' => 'title',
                'description' => 'description',
                'html_url' => 'url',
                'state' => 'state',
                'open_issues' => 0,
                'closed_issues' => 0,
                'created_at' => 'createdAt',
                'closed_at' => 'closedAt',
                'due_on' => 'dueDate',
            ]],
            [[
                'title' => 'title',
                'description' => 'description',
                'creator' => ['login' => 'creatorLogin'],
                'state' => 'state',
                'open_issues' => 0,
                'closed_issues' => 0,
                'created_at' => 'createdAt',
                'closed_at' => 'closedAt',
                'due_on' => 'dueDate',
            ]],
            [[
                'title' => 'title',
                'html_url' => 'url',
                'creator' => ['login' => 'creatorLogin'],
                'state' => 'state',
                'open_issues' => 0,
                'closed_issues' => 0,
                'created_at' => 'createdAt',
                'closed_at' => 'closedAt',
                'due_on' => 'dueDate',
            ]],
            [[
                'description' => 'description',
                'html_url' => 'url',
                'creator' => ['login' => 'creatorLogin'],
                'state' => 'state',
                'open_issues' => 0,
                'closed_issues' => 0,
                'created_at' => 'createdAt',
                'closed_at' => 'closedAt',
                'due_on' => 'dueDate',
            ]],
        ];
    }
}
