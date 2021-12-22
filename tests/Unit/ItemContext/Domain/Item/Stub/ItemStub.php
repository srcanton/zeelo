<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub;

use Zeelo\ItemContext\Domain\Item\Item;
use Zeelo\ItemContext\Domain\Item\ItemAuthor;
use Zeelo\ItemContext\Domain\Item\ItemId;
use Zeelo\ItemContext\Domain\Item\ItemImage;
use Zeelo\ItemContext\Domain\Item\ItemPrice;
use Zeelo\ItemContext\Domain\Item\ItemTitle;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Zeelo\Tests\Unit\Shared\Domain\Stub\Faker;
use Zeelo\Tests\Unit\Shared\Domain\Stub\StubInterface;

final class ItemStub implements StubInterface
{

    public function __construct(
        private ItemId $itemId,
        private ItemImage $itemImage,
        private ItemTitle $itemTitle,
        private ItemAuthor $itemAuthor,
        private ItemPrice $itemPrice,
    ) {
    }

    /**
     * @throws InvalidUuid
     * @throws NotValidUrl
     */
    public static function create(): self
    {
        return new self(
            ItemIdStub::create()->build(),
            ItemImageStub::create()->build(),
            ItemTitleStub::create()->build(),
            ItemAuthorStub::create()->build(),
            ItemPriceStub::create()->build(),
        );
    }

    public function build(): Item
    {
        return new Item(
            $this->itemId,
            $this->itemImage,
            $this->itemTitle,
            $this->itemAuthor,
            $this->itemPrice,
        );
    }
}
