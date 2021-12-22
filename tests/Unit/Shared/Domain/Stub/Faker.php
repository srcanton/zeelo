<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\Shared\Domain\Stub;

use Faker\Factory;
use Faker\Generator;

final class Faker
{
    private static $fakerFactory = null;

    public static function generate(): Generator
    {
        if (is_null(self::$fakerFactory)) {
            self::$fakerFactory = Factory::create('en_US');
        }
        return self::$fakerFactory;
    }
}
