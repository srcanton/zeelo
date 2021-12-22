<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Application\Item\Service\Response;

use Zeelo\ItemContext\Domain\Item\Item;
use Zeelo\ItemContext\Domain\Item\ItemAuthor;
use Zeelo\ItemContext\Domain\Item\ItemId;
use Zeelo\ItemContext\Domain\Item\ItemImage;
use Zeelo\ItemContext\Domain\Item\ItemPrice;
use Zeelo\ItemContext\Domain\Item\ItemTitle;
use Zeelo\Shared\Application\Service\ServiceResponseInterface;

final class ItemResponse implements ServiceResponseInterface
{
    private ItemId $id;
    private ?ItemImage $image;
    private ?ItemTitle $title;
    private ?ItemAuthor $author;
    private ?ItemPrice $price;


    public function __construct(Item $item)
    {
        $this->id = $item->id();
        $this->image = $item->image();
        $this->title = $item->title();
        $this->author = $item->author();
        $this->price = $item->price();
    }

    public function id(): ItemId
    {
        return $this->id;
    }

    public function image(): ?ItemImage
    {
        return $this->image;
    }

    public function title(): ?ItemTitle
    {
        return $this->title;
    }

    public function author(): ?ItemAuthor
    {
        return $this->author;
    }

    public function price(): ?ItemPrice
    {
        return $this->price;
    }

    public function __toArray(): array
    {
        return [
            'id' => $this->id->__toString(),
            'image' => $this->image?->__toString(),
            'title' => $this->title?->__toString(),
            'author' => $this->author?->__toString(),
            'price' => $this->price?->__toFloat()
        ];
    }
}
