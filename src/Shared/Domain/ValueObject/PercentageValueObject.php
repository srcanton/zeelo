<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

use Zeelo\Shared\Domain\Exception\InvalidPercentage;

abstract class PercentageValueObject
{
    protected $value;

    /**
     * @param int $value
     * @throws InvalidPercentage
     */
    public function __construct(int $value)
    {
        $this->ensureIsValidPercentageValue($value);
        $this->value = $value;
    }

    /**
     * @param int $value
     * @throws InvalidPercentage
     */
    private function ensureIsValidPercentageValue(int $value)
    {
        if ($value < 0 || $value > 100) {
            throw new InvalidPercentage("$value is not a valid percentage value.");
        }
    }

    public function __toString(): string
    {
        return "{$this->value}%";
    }
}
