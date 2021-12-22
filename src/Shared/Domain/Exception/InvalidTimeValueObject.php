<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\Exception;

final class InvalidTimeValueObject extends DomainException
{
    public function __construct(string $value)
    {
        parent::__construct(
            "$value is not a valid time value object. Format must be: `hour:minute:second:microsecond`"
        );
    }
}
