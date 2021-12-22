<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Application\Item\Query;

use Zeelo\ItemContext\Domain\Item\ItemId;
use Zeelo\Shared\Application\Query\QueryInterface;
use Zeelo\Shared\Domain\Exception\InvalidUuid;

class FindItemQuery implements QueryInterface
{
    private ItemId $id;

    /**
     * @throws InvalidUuid
     */
    public function __construct(
        string $id,
    ) {
        $this->id = new ItemId($id);
    }

    public function id(): ItemId
    {
        return $this->id;
    }

}
