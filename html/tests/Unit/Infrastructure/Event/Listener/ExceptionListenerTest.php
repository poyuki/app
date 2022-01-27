<?php

declare(strict_types=1);

namespace CentraApp\Tests\Infrastructure\Event\Listener;

use CentraApp\Infrastructure\Event\Listener\ExceptionListener;
use CentraApp\Infrastructure\Github\Authenticator\Exception\GithubAuthenticationException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\RouterInterface;

class ExceptionListenerTest extends TestCase
{
    private LoggerInterface|MockObject $loggerMock;
    private RouterInterface|MockObject $routerMock;
    private ExceptionListener $sut;

    protected function setUp(): void
    {
        $this->loggerMock = $this->createMock(LoggerInterface::class);
        $this->routerMock = $this->createMock(RouterInterface::class);
        $this->sut = new ExceptionListener($this->loggerMock, $this->routerMock);
    }

    public function testGithubAuthenticationException(): void
    {
        $this->loggerMock->expects($this->once())->method('warning');
        $this->loggerMock->expects($this->never())->method('error');
        $this->routerMock->expects($this->once())->method('generate')->willReturn('login');
        $event = new ExceptionEvent(
            $this->createMock(KernelInterface::class),
            new Request(),
            HttpKernelInterface::MAIN_REQUEST,
            new GithubAuthenticationException()
        );
        $this->sut->onKernelException($event);
        self::assertInstanceOf(RedirectResponse::class, $event->getResponse());
    }

    public function testException(): void
    {
        $this->loggerMock->expects($this->never())->method('warning');
        $this->loggerMock->expects($this->once())->method('error');
        $this->routerMock->expects($this->never())->method('generate');
        $event = new ExceptionEvent(
            $this->createMock(KernelInterface::class),
            new Request(),
            HttpKernelInterface::MAIN_REQUEST,
            new \Exception()
        );
        $this->sut->onKernelException($event);
        self::assertNull($event->getResponse());
    }
}
