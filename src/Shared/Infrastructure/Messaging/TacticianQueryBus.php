<?php

declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\Messaging;

use League\Tactician\CommandBus;
use Zeelo\Shared\Application\Query\QueryInterface;

class TacticianQueryBus implements QueryBusInterface
{
    private CommandBus $queryBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->queryBus = $commandBus;
    }

    public function ask(QueryInterface $query)
    {
        return $this->queryBus
            ->handle($query);
    }
}
