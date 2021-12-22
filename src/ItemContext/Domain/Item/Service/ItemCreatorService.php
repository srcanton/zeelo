<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Domain\Item\Service;

use Zeelo\ItemContext\Domain\Item\Exception\ItemAlreadyExists;
use Zeelo\ItemContext\Domain\Item\Exception\ItemNotFound;
use Zeelo\ItemContext\Domain\Item\Repository\ItemRepositoryInterface;
use Zeelo\ItemContext\Domain\Item\item;

class ItemCreatorService
{

    public function __construct(
        private ItemFinderService $itemFinder,
        private ItemRepositoryInterface $itemRepository
    ) {
    }

    /**
     * @throws ItemAlreadyExists
     */
    public function __invoke(Item $item): void
    {
        try {
            $this->itemFinder->__invoke($item->id());
            throw new ItemAlreadyExists($item->id());
        } catch (ItemNotFound $exception) {
            $this->itemRepository->save($item);
        }
    }
}
