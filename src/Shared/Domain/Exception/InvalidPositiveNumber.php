<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\Exception;

final class InvalidPositiveNumber extends DomainException
{
    public function __construct(int $value)
    {
        parent::__construct("$value is not a positive number.");
    }
}
