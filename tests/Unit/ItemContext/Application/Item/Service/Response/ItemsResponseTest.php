<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Application\Item\Service;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Application\Item\Service\Response\ItemsResponse;
use Zeelo\ItemContext\Domain\Item\Items;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub\ItemStub;

class ItemsResponseTest extends TestCase
{

    /**
     * @throws InvalidUuid
     * @throws NotValidUrl
     */
    public function testShouldCreateAItemResponse(): void
    {
        $items = [ItemStub::create()->build()];
        $items = new Items(...$items);
        $response = new ItemsResponse($items);
        self::assertInstanceOf(ItemsResponse::class, $response);
    }

}
