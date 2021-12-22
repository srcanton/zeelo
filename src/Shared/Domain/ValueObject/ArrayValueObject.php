<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

use Exception;

abstract class ArrayValueObject
{
    protected $value;

    public function __construct(array $value)
    {
        $this->value = is_array($this->value) ? $this->value + $value : $value;
    }

    public function __toString(): string
    {
        return json_encode($this->value);
    }

    public function __toArray(): array
    {
        return $this->value;
    }

    protected function ensureStringIsValid(string $value)
    {
        if (false === in_array($value, $this->availableValues())) {
            $this->throwable($value);
        }
    }

    protected function ensureArrayIsValid(array $values)
    {
        foreach ($values as $value) {
            if (false === in_array($value, $this->availableValues())) {
                $this->throwable($value);
            }
        }
    }

    abstract protected function availableValues(): array;

    abstract protected function throwable(string $value): Exception;

}
