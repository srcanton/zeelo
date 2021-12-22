<?php

declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\Messaging;

use League\Tactician\CommandBus;

class TacticianCommandBus implements CommandBusInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function handle($command)
    {
        return $this->commandBus
            ->handle($command);
    }
}
