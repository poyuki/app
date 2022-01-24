<?php

declare(strict_types=1);

namespace CentraApp\Infrastructure\Event\Listener;

use CentraApp\Infrastructure\Github\Authenticator\Exception\GithubAuthenticationException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Routing\RouterInterface;

class ExceptionListener
{
    public function __construct(
        private LoggerInterface $logger,
        private RouterInterface $router
    ) {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if($exception instanceof GithubAuthenticationException){
            $this->logger->warning($exception->getMessage());
            $event->setResponse(new RedirectResponse($this->router->generate('login')));
        }
    }
}
