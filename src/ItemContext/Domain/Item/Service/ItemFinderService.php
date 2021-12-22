<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Domain\Item\Service;

use Zeelo\ItemContext\Domain\Item\Exception\ItemNotFound;
use Zeelo\ItemContext\Domain\Item\ItemId;
use Zeelo\ItemContext\Domain\Item\Repository\ItemRepositoryInterface;
use Zeelo\ItemContext\Domain\Item\item;

class ItemFinderService
{

    public function __construct(
        private ItemRepositoryInterface $itemRepository
    ) {
    }

    /**
     * @throws ItemNotFound
     */
    public function __invoke(ItemId $id): item
    {
        $item = $this->itemRepository->findById($id);
        if (!$item instanceof item) {
            throw new ItemNotFound($id);
        }
        return $item;
    }
}
