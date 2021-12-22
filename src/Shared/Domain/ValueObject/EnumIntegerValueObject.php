<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

use Exception;

abstract class EnumIntegerValueObject extends NumberValueObject
{
    public function __construct(int $value)
    {
        $this->ensureIntegerIsValid($value);
        parent::__construct($value);
    }

    protected function ensureIntegerIsValid(int $value)
    {
        if (false === in_array($value, $this->availableValues())) {
            $this->throwable((string) $value);
        }
    }

    abstract protected function availableValues(): array;

    abstract protected function throwable(string $value): Exception;
}
