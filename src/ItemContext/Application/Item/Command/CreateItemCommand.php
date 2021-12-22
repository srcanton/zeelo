<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Application\Item\Command;


use Zeelo\ItemContext\Domain\Item\ItemAuthor;
use Zeelo\ItemContext\Domain\Item\ItemId;
use Zeelo\ItemContext\Domain\Item\ItemImage;
use Zeelo\ItemContext\Domain\Item\ItemPrice;
use Zeelo\ItemContext\Domain\Item\ItemTitle;
use Zeelo\Shared\Application\Command\CommandInterface;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;

class CreateItemCommand implements CommandInterface
{

    private ItemId $id;
    private ?ItemImage $image;
    private ?ItemTitle $title;
    private ?ItemAuthor $author;
    private ?ItemPrice $price;

    /**
     * @throws InvalidUuid
     * @throws NotValidUrl
     */
    public function __construct(
        string $id,
        ?string $image,
        ?string $title,
        ?string $author,
        ?float $price
    ) {
        $this->id = new ItemId($id);
        $this->image = $image ? new ItemImage($image) : null;
        $this->title = $title ? new ItemTitle($title) : null;
        $this->author = $author ? new ItemAuthor($author) : null;
        $this->price = $price ? new ItemPrice($price) : null;
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
}
