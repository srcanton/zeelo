<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use Zeelo\Shared\Domain\Exception\InvalidUuid;

class UuidValueObject extends StringValueObject
{
    /**
     * UuidValueObject constructor.
     * @param string|null $uuid
     * @throws InvalidUuid
     */
    public function __construct(?string $uuid = null)
    {
        $uuid = $uuid ?? Uuid::uuid4()->__toString();
        $this->ensureUuidIsValid($uuid);
        parent::__construct($uuid);
    }

    /**
     * @throws InvalidUuid
     */
    private function ensureUuidIsValid(string $uuid): void
    {
        if (!Uuid::isValid($uuid)) {
            throw new InvalidUuid('Not a valid Uuid');
        }
    }

    public function equals(UuidValueObject $id): bool
    {
        return ($id->__toString() === $this->__toString());
    }
}
