<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub;

use Zeelo\ItemContext\Domain\Item\ItemTitle;
use Zeelo\Tests\Unit\Shared\Domain\Stub\Faker;
use Zeelo\Tests\Unit\Shared\Domain\Stub\StubInterface;

final class ItemTitleStub implements StubInterface
{

    public function __construct(
        private string $title
    ) {
    }

    public static function create(): self
    {
        return new self(
            Faker::generate()->text(70)
        );
    }

    public function build(): ItemTitle
    {
        return new ItemTitle($this->title);
    }
}
