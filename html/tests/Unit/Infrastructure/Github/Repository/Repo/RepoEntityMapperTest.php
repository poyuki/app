<?php

declare(strict_types=1);

namespace CentraApp\Tests\Infrastructure\Github\Repository\Repo;

use CentraApp\Infrastructure\Github\Repository\Repo\RepoEntityMapper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyAccess\Exception\NoSuchIndexException;

class RepoEntityMapperTest extends TestCase
{
    private RepoEntityMapper $sut;

    protected function setUp(): void
    {
        $this->sut = new RepoEntityMapper();
    }

    public function testSuccessMapping(): void
    {
        $name = 'name';
        $htmlUrl = 'url';
        $visibility = 'public';
        $private = false;
        $login = 'ownerLogin';

        $entity = ($this->sut)([
            'name' => $name,
            'html_url' => $htmlUrl,
            'visibility' => $visibility,
            'private' => $private,
            'owner' => [
                'login' => $login
            ],
        ]);
        self::assertEquals($entity->getName(), $name);
        self::assertEquals($entity->getUrl(), $htmlUrl);
        self::assertEquals($entity->getVisibility(), $visibility);
        self::assertEquals($entity->isPrivate(), $private);
        self::assertEquals($entity->getOwnerLogin(), $login);
    }

    /**
     * @dataProvider getInvalidDataForMapping
     */
    public function testFailureMapping(array $input): void
    {
        $this->expectException(NoSuchIndexException::class);
        ($this->sut)($input);
    }

    public function getInvalidDataForMapping(): array
    {
        return [
            [[
                [
                    'name' => 'string',
                    'html_url' => 'string',
                    'visibility' => 'string',
                    'private' => (bool) random_int(0, 1),
                    'owner' => [

                    ]
                ]
            ]],
            [[
                [
                    'name' => 'string',
                    'html_url' => 'string',
                    'visibility' => 'string',
                    'private' => (bool) random_int(0, 1),
                ]
            ]],
            [[
                [
                    'name' => 'string',
                    'html_url' => 'string',
                    'visibility' => 'string',
                    'owner' => [
                        'login' => 'string'
                    ],
                ]
            ]],
            [[
                [
                    'name' => 'string',
                    'html_url' => 'string',
                    'private' => (bool) random_int(0, 1),
                    'owner' => [
                        'login' => 'string'
                    ],
                ]
            ]],
            [[
                [
                    'name' => 'string',
                    'visibility' => 'string',
                    'private' => (bool) random_int(0, 1),
                    'owner' => [
                        'login' => 'string'
                    ],
                ]
            ]], [[
                [
                    'html_url' => 'string',
                    'visibility' => 'string',
                    'private' => (bool) random_int(0, 1),
                    'owner' => [
                        'login' => 'string'
                    ],
                ]
            ]],
        ];
    }
}
