<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Github\Exception;

class InvalidEntityProvidedException extends \Exception
{
    public const MESSAGE_TEMPLATE = 'Invalid entity provided. Required filed `%s` is absent';
}
