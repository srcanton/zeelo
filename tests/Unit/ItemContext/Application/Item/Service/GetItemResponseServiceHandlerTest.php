<?php

declare(strict_types=1);


namespace Zeelo\Tests\Unit\ItemContext\Application\Item\Service;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Application\Item\Service\GetItemResponseService;
use Zeelo\ItemContext\Application\Item\Service\GetItemResponseServiceHandler;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub\ItemStub;

class GetItemResponseServiceHandlerTest extends TestCase
{
    private GetItemResponseServiceHandler $handler;

    protected function setUp(): void
    {
        $this->handler = new GetItemResponseServiceHandler();
    }

    /**
     * @throws InvalidUuid
     * @throws NotValidUrl
     */
    public function testItemResponseIsCreated(): void
    {
        $item = ItemStub::create()->build();

        $service = new GetItemResponseService(
            $item
        );

        $response = $this->handler
            ->handle($service);

        $this->assertEquals($item->id()->__toString(), $response->__toArray()['id']);
    }
}
