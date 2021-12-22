<?php

declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\EventListener;

use InvalidArgumentException;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ExceptionsHttpStatusCodeMapping
{
    private const DEFAULT_STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;
    private array $exceptions = [
        InvalidArgumentException::class => Response::HTTP_BAD_REQUEST,
        NotFoundHttpException::class => Response::HTTP_NOT_FOUND,
        InvalidUuid::class => Response::HTTP_BAD_REQUEST,
        NotValidUrl::class => Response::HTTP_BAD_REQUEST,
    ];

    public function register($exceptionClass, $statusCode): void
    {
        $this->exceptions[$exceptionClass] = $statusCode;
    }

    public function statusCodeFor($exceptionClass): int
    {
        return $this->exceptions[$exceptionClass] ?? self::DEFAULT_STATUS_CODE;
    }
}
