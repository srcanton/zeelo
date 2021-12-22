<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

abstract class FloatValueObject
{
    protected $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function __toFloat(): float
    {
        return $this->value ?? 0;
    }
}
