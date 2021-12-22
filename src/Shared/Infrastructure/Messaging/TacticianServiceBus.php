<?php

declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\Messaging;

use League\Tactician\CommandBus;

class TacticianServiceBus implements ServiceBusInterface
{
    private CommandBus $serviceBus;

    public function __construct(CommandBus $serviceBus)
    {
        $this->serviceBus = $serviceBus;
    }

    public function handle($service)
    {
        return $this->serviceBus
            ->handle($service);
    }
}
