<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Domain\Item\Service;

use Zeelo\ItemContext\Domain\Item\Repository\ItemRepositoryInterface;
use Zeelo\ItemContext\Domain\Item\Items;

class ItemsFinderService
{

    public function __construct(
        private ItemRepositoryInterface $itemRepository
    ) {
    }

    public function __invoke(array $params, array $orderBy = null, $limit = null, $offset = null): Items
    {
        $items = $this->itemRepository->findBy($params, $orderBy, $limit, $offset);
        return new Items(...$items);
    }
}
