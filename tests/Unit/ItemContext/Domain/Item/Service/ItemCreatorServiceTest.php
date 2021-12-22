<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Service;


use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Domain\Item\Exception\ItemAlreadyExists;
use Zeelo\ItemContext\Domain\Item\Exception\ItemNotFound;
use Zeelo\ItemContext\Domain\Item\Item;
use Zeelo\ItemContext\Domain\Item\ItemId;
use Zeelo\ItemContext\Domain\Item\Repository\ItemRepositoryInterface;
use Zeelo\ItemContext\Domain\Item\Service\ItemCreatorService;
use Zeelo\ItemContext\Domain\Item\Service\ItemFinderService;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub\ItemStub;

class ItemCreatorServiceTest extends TestCase
{
    private ItemRepositoryInterface $itemRepository;
    private ItemFinderService $itemFinderService;
    private ItemCreatorService $itemCreatorService;

    protected function setUp(): void
    {
        $this->itemFinderService = $this->createMock(ItemFinderService::class);
        $this->itemRepository = $this->createMock(ItemRepositoryInterface::class);
        $this->itemCreatorService = new ItemCreatorService($this->itemFinderService, $this->itemRepository);
    }

    /**
     * @throws ItemAlreadyExists
     * @throws InvalidUuid
     * @throws NotValidUrl
     */
    public function testShouldThrowItemAlreadyExistsException(): void
    {
        $item = ItemStub::create()->build();

        $this->itemFinderService->expects(self::once())
            ->method('__invoke')
            ->with($this->isInstanceOf(ItemId::class))
            ->willReturn(
                $item
            );

        $this->itemRepository->expects(self::never())
            ->method('save')
            ->with($this->isInstanceOf(Item::class));

        $this->expectException(ItemAlreadyExists::class);
        $this->itemCreatorService->__invoke(
            ItemStub::create()->build()
        );
    }

    /**
     * @throws ItemAlreadyExists
     * @throws InvalidUuid
     * @throws NotValidUrl
     */
    public function testWhenItemIsCreatedThenReturnResponse(): void
    {
        $item = ItemStub::create()->build();

        $this->itemFinderService->expects(self::once())
            ->method('__invoke')
            ->with($this->isInstanceOf(ItemId::class))
            ->willThrowException(
                new ItemNotFound($item->id())
            );

        $this->itemRepository->expects(self::once())
            ->method('save')
            ->with($this->isInstanceOf(Item::class));

        $this->itemCreatorService->__invoke(
            ItemStub::create()->build()
        );
        $this->assertInstanceOf(Item::class, $item);
    }
}
