<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\Event;

use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Zeelo\Shared\Domain\ValueObject\UrlValueObject;

abstract class DomainEvent
{
    private ?string $eventId;
    private string $aggregateId;
    private array $data;
    private ?UrlValueObject $webHookUrl;
    private ?DateTimeImmutable $occurredOn;

    public function __construct(
        string $aggregateId,
        array $data = [],
        ?UrlValueObject $webHookUrl = null,
        ?string $eventId = null,
        ?DateTimeImmutable $occurredOn = null
    ) {
        $this->aggregateId = $aggregateId;
        $this->data = $data;
        $this->webHookUrl = $webHookUrl ?: null;
        $this->eventId = $eventId ?: Uuid::uuid4()->toString();
        $this->occurredOn = $occurredOn ?: new DateTimeImmutable();
    }

    abstract public static function eventName(): string;

    abstract public static function eventType(): string;

    public function occurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }

    public function webHookUrl(): ?UrlValueObject
    {
        return $this->webHookUrl;
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    public function data(): array
    {
        return $this->data;
    }
}
