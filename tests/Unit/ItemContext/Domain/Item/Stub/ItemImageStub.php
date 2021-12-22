<?php

declare(strict_types=1);

namespace Zeelo\Tests\Unit\ItemContext\Domain\Item\Stub;


use Zeelo\ItemContext\Domain\Item\ItemImage;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Zeelo\Tests\Unit\Shared\Domain\Stub\Faker;
use Zeelo\Tests\Unit\Shared\Domain\Stub\StubInterface;

final class ItemImageStub implements StubInterface
{

    public function __construct(
        private string $url
    ) {
    }

    public static function create(): self
    {
        return new self(Faker::generate()->url());
    }

    /**
     * @throws NotValidUrl
     */
    public function build(): ItemImage
    {
        return new ItemImage($this->url);
    }
}
