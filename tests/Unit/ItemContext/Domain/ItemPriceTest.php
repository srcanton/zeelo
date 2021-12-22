<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Domain\Item\ItemPrice;

class ItemPriceTest extends TestCase
{

    public function testShouldCreateAItemPrice(): void
    {
        $price = new ItemPrice(ItemPriceStub::create()->build()->__toFloat());
        self::assertInstanceOf(ItemPrice::class, $price);
    }
    
}
