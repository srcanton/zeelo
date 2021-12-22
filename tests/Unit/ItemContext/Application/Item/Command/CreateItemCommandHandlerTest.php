<?php

declare(strict_types=1);


namespace Zeelo\Tests\Unit\ItemContext\Application\Item\Command;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Application\Item\Command\CreateItemCommand;
use Zeelo\ItemContext\Application\Item\Command\CreateItemCommandHandler;
use Zeelo\ItemContext\Domain\Item\Exception\ItemAlreadyExists;
use Zeelo\ItemContext\Domain\Item\Service\ItemCreatorService;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub\ItemStub;

class CreateItemCommandHandlerTest extends TestCase
{
    private ItemCreatorService $itemCreatorService;
    private CreateItemCommandHandler $handler;

    protected function setUp(): void
    {
        $this->itemCreatorService = $this->createMock(ItemCreatorService::class);
        $this->handler = new CreateItemCommandHandler($this->itemCreatorService);
    }

    /**
     * @throws InvalidUuid|NotValidUrl
     */
    public function testShouldThrowItemAlreadyExistsException(): void
    {
        $item = ItemStub::create()->build();

        $command = new CreateItemCommand(
            $item->id()->__toString(),
            $item->image()->__toString(),
            $item->title()->__toString(),
            $item->author()->__toString(),
            $item->price()->__toFloat(),
        );

        $this->itemCreatorService
            ->expects($this->once())
            ->method('__invoke')
            ->with(
                $item
            )
            ->willThrowException(
                new ItemAlreadyExists($item->id())
            );

        $this->expectException(ItemAlreadyExists::class);
        $this->handler->handle($command);
    }

    /**
     * @throws InvalidUuid
     * @throws NotValidUrl
     * @throws ItemAlreadyExists
     */
    public function testItemIsCreated(): void
    {
        $item = ItemStub::create()->build();

        $command = new CreateItemCommand(
            $item->id()->__toString(),
            $item->image()->__toString(),
            $item->title()->__toString(),
            $item->author()->__toString(),
            $item->price()->__toFloat(),
        );

        $this->itemCreatorService
            ->expects($this->once())
            ->method('__invoke')
            ->with(
                $item
            );

        $this->handler
            ->handle($command);
    }
}
