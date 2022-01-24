<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Github\Repository\Milestone;

use CentraApp\Domain\Milestone;
use Symfony\Component\PropertyAccess\PropertyAccessorBuilder;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class MilestoneEntityMapper
{
    private const TITLE_PATH = '[title]';
    private const DESCRIPTION_PATH = '[description]';
    private const URL_PATH = '[html_url]';
    private const CREATOR_LOGIN_PATH = '[creator][login]';
    private const STATE_PATH = '[state]';
    private const OPEN_ISSUE_COUNT_PATH = '[open_issues]';
    private const CLOSED_ISSUE_COUNT_PATH = '[closed_issues]';
    private const CREATED_AT_PATH = '[created_at]';
    private const CLOSED_AT_PATH = '[closed_at]';
    private const DUE_DATE_PATH = '[due_on]';

    private PropertyAccessorInterface $propertyAccessor;

    public function __construct()
    {
        $propertyAccessorBuilder = new PropertyAccessorBuilder();
        $propertyAccessorBuilder->enableExceptionOnInvalidIndex();
        $this->propertyAccessor = $propertyAccessorBuilder->getPropertyAccessor();
    }

    public function __invoke(array $rawResponseEntity): Milestone
    {
        return new Milestone(
            $this->propertyAccessor->getValue($rawResponseEntity, self::TITLE_PATH),
            $this->propertyAccessor->getValue($rawResponseEntity, self::DESCRIPTION_PATH),
            $this->propertyAccessor->getValue($rawResponseEntity, self::URL_PATH),
            $this->propertyAccessor->getValue($rawResponseEntity, self::CREATOR_LOGIN_PATH),
            $this->propertyAccessor->getValue($rawResponseEntity, self::STATE_PATH),
            $this->propertyAccessor->getValue($rawResponseEntity, self::OPEN_ISSUE_COUNT_PATH),
            $this->propertyAccessor->getValue($rawResponseEntity, self::CLOSED_ISSUE_COUNT_PATH),
            $this->propertyAccessor->getValue($rawResponseEntity, self::CREATED_AT_PATH),
            $this->propertyAccessor->getValue($rawResponseEntity, self::CLOSED_AT_PATH),
            $this->propertyAccessor->getValue($rawResponseEntity, self::DUE_DATE_PATH),
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
