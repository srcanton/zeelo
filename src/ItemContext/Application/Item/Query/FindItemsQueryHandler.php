<?php
declare(strict_types=1);

namespace Zeelo\ItemContext\Application\Item\Query;

use Zeelo\ItemContext\Application\Item\Service\GetItemsResponseService;
use Zeelo\ItemContext\Domain\Item\Service\ItemsFinderService;
use Zeelo\Shared\Application\Service\ServiceResponseInterface;
use Zeelo\Shared\Infrastructure\Messaging\ServiceBusInterface;

class FindItemsQueryHandler
{
    public function __construct(
        private ItemsFinderService $itemFinder,
        private ServiceBusInterface $serviceBus
    )
    {
    }

    public function handle(FindItemsQuery $query): ServiceResponseInterface
    {
        $items = $this->itemFinder->__invoke(
            [],
            null,
            $query->count(),
            $query->offset(),
        );
        return $this->serviceBus->handle(
            new GetItemsResponseService(
                $items
            )
        );
    }
}
