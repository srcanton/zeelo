<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Domain\Item\ItemImage;
use Zeelo\Shared\Domain\Exception\NotValidUrl;

class ItemImageTest extends TestCase
{
    public function testWhenImageUrlIsNotValidThrowsException(): void
    {
        $this->expectException(NotValidUrl::class);
        new ItemImage('123');
    }

    /**
     * @throws NotValidUrl
     */
    public function testShouldCreateAItemImage(): void
    {
        $image = new ItemImage(ItemImageStub::create()->build()->__toString());
        self::assertInstanceOf(ItemImage::class, $image);
    }
}
