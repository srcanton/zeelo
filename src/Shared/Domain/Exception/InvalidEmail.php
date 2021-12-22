<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\Exception;

final class InvalidEmail extends DomainException
{
    public function __construct(string $value)
    {
        parent::__construct("$value is not a email.");
    }
}
