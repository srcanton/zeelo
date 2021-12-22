<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

abstract class EmbeddedValueObject
{
    abstract public function __toArray(): array;
}
