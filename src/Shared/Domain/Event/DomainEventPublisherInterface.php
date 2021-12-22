<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\Event;

interface DomainEventPublisherInterface
{
    public function publish(DomainEvent ...$domainEvents): void;
}
