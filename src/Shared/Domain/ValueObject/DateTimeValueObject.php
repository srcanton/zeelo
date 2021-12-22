<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

use DateTimeImmutable;
use DateTimeInterface;

abstract class DateTimeValueObject
{
    protected $value;

    public function __construct(DateTimeImmutable $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value->format(DateTimeInterface::ATOM);
    }

    public function value()
    {
        return $this->value;
    }

    public function isNotNull(): bool
    {
        return !(is_null($this->value));
    }
}
