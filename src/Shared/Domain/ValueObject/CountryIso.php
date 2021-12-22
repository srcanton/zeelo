<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

use League\ISO3166\ISO3166;
use Zeelo\Shared\Domain\Exception\NotValidIsoCode;

final class CountryIso extends StringValueObject
{
    public function __construct(string $value)
    {
        $value = strtoupper($value);
        $this->ensureIsValidIsoCode($value);
        parent::__construct($value);
    }

    private function ensureIsValidIsoCode(string $value): void
    {
        try {
            if (2 !== strlen($value)) {
                throw new NotValidIsoCode("Iso code should have exactly 2 characters.");
            }
            (new ISO3166())->alpha2($value);
        }catch (\Exception $exception) {
            throw new NotValidIsoCode("$value is not a valid country iso code.");
        }
    }
}
