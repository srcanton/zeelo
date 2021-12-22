<?php

declare(strict_types=1);


namespace Zeelo\Tests\Unit\ItemContext\Application\Item\Query;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Application\Item\Query\FindItemQuery;
use Zeelo\ItemContext\Application\Item\Query\FindItemQueryHandler;
use Zeelo\ItemContext\Application\Item\Service\GetItemResponseService;
use Zeelo\ItemContext\Application\Item\Service\Response\ItemResponse;
use Zeelo\ItemContext\Domain\Item\Exception\ItemNotFound;
use Zeelo\ItemContext\Domain\Item\Service\ItemFinderService;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Zeelo\Shared\Infrastructure\Messaging\ServiceBusInterface;
use Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub\ItemIdStub;
use Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub\ItemStub;

class FindItemQueryHandlerTest extends TestCase
{
    private FindItemQueryHandler $handler;
    private ServiceBusInterface $serviceBus;
    private ItemFinderService $itemFinderService;

    protected function setUp(): void
    {
        $this->itemFinderService = $this->createMock(ItemFinderService::class);
        $this->serviceBus = $this->createMock(ServiceBusInterface::class);
        $this->handler = new FindItemQueryHandler($this->itemFinderService, $this->serviceBus);
    }

    /**
     * @throws ItemNotFound
     * @throws InvalidUuid
     */
    public function testShouldThrowItemNotFoundException(): void
    {
        $itemId = ItemIdStub::create()->build();

        $query = new FindItemQuery(
            $itemId->__toString()
        );

        $this->itemFinderService
            ->expects($this->once())
            ->method('__invoke')
            ->with(
                $query->id()
            )
            ->willThrowException(
                new ItemNotFound($itemId)
            );

        $this->serviceBus
            ->expects($this->never())
            ->method('handle');

        $this->expectException(ItemNotFound::class);
        $this->handler->handle($query);
    }

    /**
     * @throws ItemNotFound
     * @throws InvalidUuid
     * @throws NotValidUrl
     */
    public function testItemIsFound(): void
    {
        $item = ItemStub::create()->build();
        $itemResponse = new ItemResponse(
            $item
        );

        $query = new FindItemQuery(
            $item->id()->__toString()
        );

        $this->itemFinderService
            ->expects($this->once())
            ->method('__invoke')
            ->with(
                $query->id()
            )
            ->willReturn($item);

        $this->serviceBus
            ->expects($this->once())
            ->method('handle')
            ->with($this->isInstanceOf(GetItemResponseService::class))
            ->willReturn($itemResponse);

        $response = $this->handler
            ->handle($query);

        $this->assertEquals($item->id()->__toString(), $response->__toArray()['id']);
    }
}
