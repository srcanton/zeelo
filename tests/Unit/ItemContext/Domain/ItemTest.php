<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Domain\Item\Item;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;

class ItemTest extends TestCase
{
    /**
     * @throws InvalidUuid|NotValidUrl
     */
    public function testShouldCreateAItem(): void
    {
        $item = new Item(
            ItemIdStub::create()->build(),
            ItemImageStub::create()->build(),
            ItemTitleStub::create()->build(),
            ItemAuthorStub::create()->build(),
            ItemPriceStub::create()->build(),
        );
        self::assertInstanceOf(Item::class, $item);
    }
}
