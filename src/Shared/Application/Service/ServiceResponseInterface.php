<?php

declare(strict_types=1);

namespace Zeelo\Shared\Application\Service;

interface ServiceResponseInterface
{
    public function __toArray(): array;
}
