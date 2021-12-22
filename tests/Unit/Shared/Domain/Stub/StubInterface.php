<?php
declare(strict_types=1);

namespace Zeelo\Tests\Unit\Shared\Domain\Stub;

interface StubInterface
{
    public static function create(): self;
}
