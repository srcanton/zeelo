<?php

declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\Exception;

use Exception;

abstract class InfrastructureException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
