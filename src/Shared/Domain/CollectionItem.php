<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain;

interface CollectionItem
{
    public function __toArray(): array;
}
