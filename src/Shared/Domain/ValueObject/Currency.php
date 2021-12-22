<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

use Zeelo\Shared\Domain\Exception\NotValidCurrency;

final class Currency extends StringValueObject
{
    public function __construct(string $value)
    {
        $value = strtoupper($value);
        $this->ensureIsValidCurrency($value);
        parent::__construct($value);
    }

    private function ensureIsValidCurrency(string $value): void
    {
        if (3 !== strlen($value)) {
            throw new NotValidCurrency("$value is not a valid currency code.");
        }
    }
}
