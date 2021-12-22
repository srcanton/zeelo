<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub;


use Zeelo\ItemContext\Domain\Item\ItemPrice;
use Zeelo\Tests\Unit\Shared\Domain\Stub\Faker;
use Zeelo\Tests\Unit\Shared\Domain\Stub\StubInterface;

final class ItemPriceStub implements StubInterface
{

    public function __construct(
        private float $price
    ) {
    }

    public static function create(): self
    {
        return new self(Faker::generate()->randomFloat());
    }

    public function build(): ItemPrice
    {
        return new ItemPrice($this->price);
    }
}
