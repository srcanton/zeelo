<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

use DateTimeImmutable;

abstract class DateValueObject extends DateTimeValueObject
{
    public function __toString(): string
    {
        return $this->value ? $this->value->format('Y-m-d') : '';
    }

    public function isPast(): bool
    {
        $now = new DateTimeImmutable('now');
        return $now > $this->value;
    }

    public function toSeconds(): int
    {
        return (int)$this->value->format('U');
    }
}
