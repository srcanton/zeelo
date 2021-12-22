<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Application\Item\Service;

use PHPUnit\Framework\TestCase;
use Zeelo\ItemContext\Application\Item\Service\Response\ItemHateoasResponse;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub\ItemStub;

class ItemHateoasResponseTest extends TestCase
{

    /**
     * @throws InvalidUuid
     * @throws NotValidUrl
     */
    public function testShouldCreateAItemHateoasResponse(): void
    {
        $response = new ItemHateoasResponse(ItemStub::create()->build());
        self::assertInstanceOf(ItemHateoasResponse::class, $response);
    }

}
