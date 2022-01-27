<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Github\Repository\Repo;

use CentraApp\Domain\Repo;
use Symfony\Component\PropertyAccess\PropertyAccessorBuilder;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class RepoEntityMapper
{
    private const NAME_PATH = '[name]';
    private const URL_PATH = '[html_url]';
    private const VISIBILITY_PATH = '[visibility]';
    private const PRIVATE_PATH = '[private]';
    private const OWNER_LOGIN_PATH = '[owner][login]';

    private PropertyAccessorInterface $propertyAccessor;

    public function __construct()
    {
        $propertyAccessorBuilder = new PropertyAccessorBuilder();
        $propertyAccessorBuilder->enableExceptionOnInvalidIndex();
        $this->propertyAccessor = $propertyAccessorBuilder->getPropertyAccessor();
    }

    public function __invoke(array $rawResponseEntity): Repo
    {
        return new Repo(
            $this->propertyAccessor->getValue($rawResponseEntity, self::NAME_PATH),
            $this->propertyAccessor->getValue($rawResponseEntity, self::URL_PATH),
            $this->propertyAccessor->getValue($rawResponseEntity, self::VISIBILITY_PATH),
            $this->propertyAccessor->getValue($rawResponseEntity, self::PRIVATE_PATH),
            $this->propertyAccessor->getValue($rawResponseEntity, self::OWNER_LOGIN_PATH)
        );
    }

    /**
     * @param PropertyAccessorInterface $propertyAccessor
     */
    public function setPropertyAccessor(PropertyAccessorInterface $propertyAccessor): void
    {
        $this->propertyAccessor = $propertyAccessor;
    }
}
