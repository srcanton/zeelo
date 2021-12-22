<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Application\Item\Command;

use Zeelo\ItemContext\Domain\Item\Exception\ItemAlreadyExists;
use Zeelo\ItemContext\Domain\Item\Item;
use Zeelo\ItemContext\Domain\Item\Service\ItemCreatorService;

class CreateItemCommandHandler
{

    public function __construct(
        private ItemCreatorService $creatorService
    ) {
    }

    /**
     * @param CreateItemCommand $command
     * @throws ItemAlreadyExists
     */
    public function handle(CreateItemCommand $command): void
    {
        $this->creatorService->__invoke(
            new Item(
                $command->id(),
                $command->image(),
                $command->title(),
                $command->author(),
                $command->price(),
            )
        );
    }
}
