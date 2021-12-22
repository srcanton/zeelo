<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Application\Item\Query;

use Zeelo\ItemContext\Application\Item\Service\GetItemResponseService;
use Zeelo\ItemContext\Domain\Item\Exception\ItemNotFound;
use Zeelo\ItemContext\Domain\Item\Service\ItemFinderService;
use Zeelo\Shared\Application\Service\ServiceResponseInterface;
use Zeelo\Shared\Infrastructure\Messaging\ServiceBusInterface;

class FindItemQueryHandler
{
    public function __construct(
        private ItemFinderService $itemFinder,
        private ServiceBusInterface $serviceBus
    ) {
    }

    /**
     * @throws ItemNotFound
     */
    public function handle(FindItemQuery $query): ServiceResponseInterface
    {
        $item = $this->itemFinder->__invoke(
            $query->id()
        );
        return $this->serviceBus->handle(
            new GetItemResponseService(
                $item
            )
        );
    }
}
