<?php

declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\Messaging;

use Zeelo\Shared\Application\Query\QueryInterface;

interface QueryBusInterface
{
    public function ask(QueryInterface $query);
}
