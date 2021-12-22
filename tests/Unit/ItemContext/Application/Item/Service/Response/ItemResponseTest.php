<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Application\Item\Service;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Application\Item\Service\Response\ItemResponse;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub\ItemStub;

class ItemResponseTest extends TestCase
{

    /**
     * @throws InvalidUuid
     * @throws NotValidUrl
     */
    public function testShouldCreateAItemResponse(): void
    {
        $response = new ItemResponse(ItemStub::create()->build());
        self::assertInstanceOf(ItemResponse::class, $response);
    }

}
