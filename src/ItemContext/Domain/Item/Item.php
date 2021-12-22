<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Domain\Item;


use Zeelo\Shared\Domain\AggregateRoot;

class Item extends AggregateRoot
{

    public function __construct(
        private ItemId $id,
        private ?ItemImage $image,
        private ?ItemTitle $title,
        private ?ItemAuthor $author,
        private ?ItemPrice $price,
    ) {
    }

    public function id(): ItemId
    {
        return $this->id;
    }

    public function image(): ?ItemImage
    {
        return $this->image;
    }

    public function setImage(?ItemImage $image): void
    {
        $this->image = $image;
    }

    public function title(): ?ItemTitle
    {
        return $this->title;
    }

    public function setTitle(?ItemTitle $title): void
    {
        $this->title = $title;
    }

    public function author(): ?ItemAuthor
    {
        return $this->author;
    }

    public function setAuthor(?ItemAuthor $author): void
    {
        $this->author = $author;
    }

    public function price(): ?ItemPrice
    {
        return $this->price;
    }

    public function setPrice(?ItemPrice $price): void
    {
        $this->price = $price;
    }

    public function __toArray(): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image?->__toString(),
            'title' => $this->title?->__toString(),
            'author' => $this->author?->__toString(),
            'price' => $this->price?->__toFloat(),
        ];
    }
}
