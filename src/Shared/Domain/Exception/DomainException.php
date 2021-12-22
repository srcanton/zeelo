<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\Exception;

use Exception;

abstract class DomainException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
