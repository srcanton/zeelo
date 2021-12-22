<?php
declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Service;


use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Domain\Item\Exception\ItemNotFound;
use Zeelo\ItemContext\Domain\Item\Item;
use Zeelo\ItemContext\Domain\Item\Repository\ItemRepositoryInterface;
use Zeelo\ItemContext\Domain\Item\Service\ItemFinderService;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub\ItemIdStub;
use Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub\ItemStub;

class ItemFinderServiceTest extends TestCase
{
    private ItemRepositoryInterface $itemRepository;
    private ItemFinderService $itemService;

    protected function setUp(): void
    {
        $this->itemRepository = $this->createMock(ItemRepositoryInterface::class);
        $this->itemService = new ItemFinderService($this->itemRepository);
    }

    public function testShouldThrowItemNotFoundException(): void
    {
        $itemId = ItemIdStub::create()->build();
        $this->itemRepository
            ->expects($this->once())
            ->method('findById')
            ->with($itemId)
            ->willReturn(null)
            ->willThrowException(
                new ItemNotFound($itemId)
            );

        $this->expectException(ItemNotFound::class);
        $this->itemService->__invoke($itemId);
    }

    /**
     * @throws ItemNotFound
     * @throws InvalidUuid
     * @throws NotValidUrl
     */
    public function testWhenItemIsFoundThenReturnResponse(): void
    {
        $itemStub = ItemStub::create()->build();

        $this->itemRepository
            ->expects($this->once())
            ->method('findById')
            ->with($itemStub->id())
            ->willReturn($itemStub);

        $item = $this->itemService->__invoke(
            $itemStub->id()
        );
        $this->assertInstanceOf(Item::class, $item);
    }

}
