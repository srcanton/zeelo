<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

abstract class NumberValueObject
{
    protected $value;

    public function __construct(int $value = 0)
    {
        $this->value = $value;
    }

    public function __toInt(): ?int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return "$this->value";
    }
}
