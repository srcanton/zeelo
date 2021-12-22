<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

use Zeelo\Shared\Domain\Exception\InvalidEmail;

abstract class EmailValueObject
{
    protected $value;

    /**
     * EmailValueObject constructor.
     * @param string $value
     * @throws InvalidEmail
     */
    public function __construct(string $value)
    {
        $this->ensureIsValidEmailValue($value);
        $this->value = $value;
    }

    /**
     * @param string $value
     * @throws InvalidEmail
     */
    private function ensureIsValidEmailValue(string $value)
    {
        if (false === filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmail($value);
        }
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
