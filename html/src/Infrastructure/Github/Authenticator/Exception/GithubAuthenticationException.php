<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Github\Authenticator\Exception;

use Throwable;

class GithubAuthenticationException extends \Exception
{
    public function __construct(string $message = "User Not Authorized", int $code = 401, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
