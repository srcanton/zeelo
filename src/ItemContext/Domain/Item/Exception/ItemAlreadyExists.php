<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Domain\Item\Exception;

use Zeelo\ItemContext\Domain\Item\ItemId;
use Zeelo\Shared\Domain\Exception\DomainException;

final class ItemAlreadyExists extends DomainException
{
    public function __construct(ItemId $exceptionValue)
    {
        $message = "Item {$exceptionValue} already exists.";
        parent::__construct($message);
    }
}
