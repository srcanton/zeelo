<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Application\Item\Service;

use Zeelo\ItemContext\Domain\Item\Item;
use Zeelo\Shared\Application\Service\ServiceInterface;

class GetItemResponseService implements ServiceInterface
{

    public function __construct(
        private Item $item,
    ) {
    }

    public function item(): Item
    {
        return $this->item;
    }
}
