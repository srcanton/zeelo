<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

abstract class StringValueObject
{
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function isEmpty(): bool
    {
        return (string)$this->value === '';
    }

    public function sameAs(string $value): bool
    {
        return (string)$this->value === $value;
    }
}
