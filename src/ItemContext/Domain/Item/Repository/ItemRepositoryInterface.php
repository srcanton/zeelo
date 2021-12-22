<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Domain\Item\Repository;


use Zeelo\ItemContext\Domain\Item\Item;
use Zeelo\ItemContext\Domain\Item\ItemId;

interface ItemRepositoryInterface
{
    public function findById(ItemId $id): ?Item;

    public function findBy(array $params, array $orderBy = null, $limit = null, $offset = null): ?array;

    public function save(Item $item): void;

}
