<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Infrastructure\Item\Persistence\DBAL;

use Zeelo\ItemContext\Domain\Item\ItemId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Zeelo\Shared\Domain\Exception\InvalidUuid;

class ItemIdType extends GuidType
{
    /**
     * @throws InvalidUuid
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return empty($value) ? $value : new ItemId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof ItemId) {
            return $value->__toString();
        }

        return null;
    }
}
