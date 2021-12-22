<?php

declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\Messaging;

use Zeelo\Shared\Application\Command\CommandInterface;

interface CommandBusInterface
{
    public function handle(CommandInterface $command);
}
