<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub;


use Ramsey\Uuid\Uuid;
use Zeelo\ItemContext\Domain\Item\ItemId;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Tests\Unit\Shared\Domain\Stub\StubInterface;

final class ItemIdStub implements StubInterface
{

    public function __construct(
        private string $itemId
    ) {
    }

    public static function create(): self
    {
        return new self((string)Uuid::uuid4());
    }

    /**
     * @throws InvalidUuid
     */
    public function build(): ItemId
    {
        return new ItemId($this->itemId);
    }
}
