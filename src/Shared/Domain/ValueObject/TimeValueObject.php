<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

use DateTimeImmutable;
use Zeelo\Shared\Domain\Exception\InvalidTimeValueObject;

abstract class TimeValueObject extends DateValueObject
{
    private const FORMAT = 'H:i:s:u';

    /**
     * @throws InvalidTimeValueObject
     */
    public function __construct(string $value)
    {
        $time = DateTimeImmutable::createFromFormat(self::FORMAT, $value);
        if (false === $time) {
            throw new InvalidTimeValueObject($value);
        }
        parent::__construct($time);
    }

    public function __toString(): string
    {
        return $this->value->format(self::FORMAT);
    }
}
