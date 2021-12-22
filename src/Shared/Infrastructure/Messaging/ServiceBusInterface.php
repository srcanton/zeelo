<?php

declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\Messaging;

use Zeelo\Shared\Application\Service\ServiceInterface;

interface ServiceBusInterface
{
    public function handle(ServiceInterface $service);
}
