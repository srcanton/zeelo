<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Application\Item\Service;

use Zeelo\ItemContext\Domain\Item\Items;
use Zeelo\Shared\Application\Service\ServiceInterface;

class GetItemsResponseService implements ServiceInterface
{

    public function __construct(
        private Items $items,
    ) {
    }

    public function items(): Items
    {
        return $this->items;
    }
}
