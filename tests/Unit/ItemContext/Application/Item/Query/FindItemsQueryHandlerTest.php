<?php

declare(strict_types=1);


namespace Zeelo\Tests\Unit\ItemContext\Application\Item\Query;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Application\Item\Query\FindItemsQuery;
use Zeelo\ItemContext\Application\Item\Query\FindItemsQueryHandler;
use Zeelo\ItemContext\Application\Item\Service\GetItemsResponseService;
use Zeelo\ItemContext\Application\Item\Service\Response\ItemsResponse;
use Zeelo\ItemContext\Domain\Item\Items;
use Zeelo\ItemContext\Domain\Item\Service\ItemsFinderService;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Zeelo\Shared\Infrastructure\Messaging\ServiceBusInterface;
use Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub\ItemStub;

class FindItemsQueryHandlerTest extends TestCase
{
    private FindItemsQueryHandler $handler;
    private ServiceBusInterface $serviceBus;
    private ItemsFinderService $itemsFinderService;

    protected function setUp(): void
    {
        $this->itemsFinderService = $this->createMock(ItemsFinderService::class);
        $this->serviceBus = $this->createMock(ServiceBusInterface::class);
        $this->handler = new FindItemsQueryHandler($this->itemsFinderService, $this->serviceBus);
    }

    /**
     * @throws InvalidUuid
     * @throws NotValidUrl
     */
    public function testItemsAreFound(): void
    {
        $items = [ItemStub::create()->build()];
        $items = new Items(...$items);
        $itemsResponse = new ItemsResponse(
            $items
        );

        $query = new FindItemsQuery(
            null,
            null
        );

        $this->itemsFinderService
            ->expects($this->once())
            ->method('__invoke')
            ->with(
                [],
                null,
                $query->count(),
                $query->offset(),
            )
            ->willReturn($items);

        $this->serviceBus
            ->expects($this->once())
            ->method('handle')
            ->with($this->isInstanceOf(GetItemsResponseService::class))
            ->willReturn($itemsResponse);

        $response = $this->handler
            ->handle($query);

        $this->assertEquals($items[0]->id()->__toString(), $response->__toArray()[0]['id']);
    }
}
