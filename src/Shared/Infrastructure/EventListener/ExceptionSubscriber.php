<?php

declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\EventListener;

use Psr\Log\LoggerInterface;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Throwable;

final class ExceptionSubscriber implements EventSubscriberInterface
{
    private ExceptionsHttpStatusCodeMapping $exceptionHandler;
    private LoggerInterface $logger;

    public function __construct(ExceptionsHttpStatusCodeMapping $exceptionHandler, LoggerInterface $logger)
    {
        $this->exceptionHandler = $exceptionHandler;
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onException',
        ];
    }

    /**
     * @throws ReflectionException
     */
    public function onException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $this->logger->error($exception->getMessage());
        $event->setResponse(
            new JsonResponse(
                [
                    'error_type' => $this->exceptionTypeFor($exception),
                    'message' => $exception->getMessage(),
                ],
                $this->exceptionHandler->statusCodeFor(get_class($exception))
            )
        );
    }

    /**
     * @throws ReflectionException
     */
    private function exceptionTypeFor(Throwable $error): string
    {
        $nameConverter = new CamelCaseToSnakeCaseNameConverter();

        return str_replace('_exception', '', $nameConverter->normalize((new ReflectionClass($error))->getShortName()));
    }
}
