<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Domain\Item;

use Zeelo\Shared\Domain\Collection;

final class Items extends Collection
{
    private array $items;

    public function __construct(
        Item ...$items
    ) {
        $this->items = $items;
        parent::__construct($items);
    }

    public function __toArray(): array
    {
        $response = [];
        foreach ($this->items as $item) {
            $response[] = $item->__toArray();
        }

        return $response;
    }
}
