<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Domain\Item\ItemAuthor;

class ItemAuthorTest extends TestCase
{

    public function testShouldCreateAItemAuthor(): void
    {
        $image = new ItemAuthor(ItemAuthorStub::create()->build()->__toString());
        self::assertInstanceOf(ItemAuthor::class, $image);
    }

}
