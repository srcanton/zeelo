<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

use Exception;

abstract class EnumStringValueObject extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureStringIsValid($value);
        parent::__construct($value);
    }

    protected function ensureStringIsValid(string $value)
    {
        if (false === in_array($value, $this->availableValues())) {
            $this->throwable($value);
        }
    }

    abstract protected function availableValues(): array;

    abstract protected function throwable(string $value): Exception;
}
