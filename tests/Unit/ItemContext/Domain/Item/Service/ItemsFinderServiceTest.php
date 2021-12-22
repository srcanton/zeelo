<?php
declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Service;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Domain\Item\Repository\ItemRepositoryInterface;
use Zeelo\ItemContext\Domain\Item\Service\ItemsFinderService;
use Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub\ItemStub;

class ItemsFinderServiceTest extends TestCase
{
    private ItemRepositoryInterface $itemRepository;
    private ItemsFinderService $itemsFinderService;

    protected function setUp(): void
    {
        $this->itemRepository = $this->createMock(ItemRepositoryInterface::class);
        $this->itemsFinderService = new ItemsFinderService($this->itemRepository);
    }

    public function testWhenItemsAreFoundThenReturnResponse(): void
    {
        $items = [ItemStub::create()->build()];

        $this->itemRepository
            ->expects($this->once())
            ->method('findBy')
            ->with([])
            ->willReturn($items);

        $this->itemsFinderService->__invoke([]);
        $this->assertIsArray($items);
    }
}
