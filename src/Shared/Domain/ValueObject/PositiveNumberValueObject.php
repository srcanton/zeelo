<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

use Zeelo\Shared\Domain\Exception\InvalidPositiveNumber;

abstract class PositiveNumberValueObject extends NumberValueObject
{
    /**
     * @throws InvalidPositiveNumber
     */
    public function __construct(int $value = 0)
    {
        $this->ensureValueIsPositive($value);
        parent::__construct($value);
    }

    /**
     * @throws InvalidPositiveNumber
     */
    private function ensureValueIsPositive(int $value): void
    {
        if ($value < 0) {
            throw new InvalidPositiveNumber($value);
        }
    }
}
