<?php

declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\Http;

use Symfony\Component\HttpFoundation\Response;

final class JsonResponse extends Response
{
    public function __construct(?array $data = [], $status = Response::HTTP_OK)
    {
        parent::__construct(json_encode($data), $status, ['Content-Type' => 'application/json']);
    }
}
