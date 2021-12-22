<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Domain\Item\ItemTitle;

class ItemTitleTest extends TestCase
{

    public function testShouldCreateAItemTitle(): void
    {
        $image = new ItemTitle(ItemTitleStub::create()->build()->__toString());
        self::assertInstanceOf(ItemTitle::class, $image);
    }
    
}
