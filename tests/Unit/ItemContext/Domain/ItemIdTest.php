<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Domain\Item\ItemId;
use Zeelo\Shared\Domain\Exception\InvalidUuid;

class ItemIdTest extends TestCase
{
    public function testWhenUuidIsNotValidThrowsException(): void
    {
        $this->expectException(InvalidUuid::class);
        new ItemId('123');
    }

    /**
     * @throws InvalidUuid
     */
    public function testShouldCreateAItemId(): void
    {
        $uuid = new ItemId(ItemIdStub::create()->build()->__toString());
        self::assertInstanceOf(ItemId::class, $uuid);
    }
}
