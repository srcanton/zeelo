<?php

declare(strict_types=1);


namespace Zeelo\Tests\Unit\ItemContext\Application\Item\Service;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Application\Item\Service\GetItemsResponseService;
use Zeelo\ItemContext\Application\Item\Service\GetItemsResponseServiceHandler;
use Zeelo\ItemContext\Domain\Item\Items;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub\ItemStub;

class GetItemsResponseServiceHandlerTest extends TestCase
{
    private GetItemsResponseServiceHandler $handler;

    protected function setUp(): void
    {
        $this->handler = new GetItemsResponseServiceHandler();
    }

    /**
     * @throws InvalidUuid
     * @throws NotValidUrl
     */
    public function testItemsResponseIsCreated(): void
    {
        $items = [ItemStub::create()->build()];
        $items = new Items(...$items);

        $service = new GetItemsResponseService(
            $items
        );

        $response = $this->handler
            ->handle($service);

        $this->assertEquals($items[0]->id()->__toString(), $response->__toArray()[0]['id']);
    }
}
