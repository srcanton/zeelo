<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Application\Item\Query;

use Zeelo\Shared\Application\Query\QueryInterface;

class FindItemsQuery implements QueryInterface
{

    public function __construct(
        private ?int $count,
        private ?int $offset
    ) {
    }

    public function count(): ?int
    {
        return $this->count;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }
}
