<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Application\Item\Service\Response;

use Zeelo\ItemContext\Domain\Item\Items;
use Zeelo\Shared\Application\Service\ServiceResponseInterface;

final class ItemsResponse implements ServiceResponseInterface
{
    private array $items = [];

    public function __construct(Items $items)
    {
        if (!empty($items)) {
            foreach ($items as $item) {
                $itemResponse = new ItemHateoasResponse($item);
                $this->items[] = $itemResponse->__toArray();
            }
        }
    }

    public function __toArray(): array
    {
        return $this->items;
    }
}
