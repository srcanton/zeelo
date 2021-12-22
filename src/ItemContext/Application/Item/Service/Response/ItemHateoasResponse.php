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

final class ItemHateoasResponse implements ServiceResponseInterface
{
    private const API_V1_VERSION = '/api/v1/';
    private ItemId $id;
    private string $link;
    private ?ItemTitle $title;


    public function __construct(Item $item)
    {
        $this->id = $item->id();
        $this->link = self::API_V1_VERSION . $item->id()->__toString();
        $this->title = $item->title();
    }

    public function id(): ItemId
    {
        return $this->id;
    }

    public function link(): string
    {
        return $this->link;
    }

    public function title(): ?ItemTitle
    {
        return $this->title;
    }

    public function __toArray(): array
    {
        return [
            'id' => $this->id->__toString(),
            'link' => $this->link,
            'title' => $this->title?->__toString()
        ];
    }
}
