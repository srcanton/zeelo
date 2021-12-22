<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

use Zeelo\Shared\Domain\Exception\NotValidUrl;

abstract class UrlValueObject extends StringValueObject
{
    /**
     * * @throws NotValidUrl
     */
    public function __construct(string $url)
    {
        $this->ensureIsValidUrl($url);
        parent::__construct($url);
    }

    /**
     * @throws NotValidUrl
     */
    private function ensureIsValidUrl($url): void
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new NotValidUrl("{$url} is not a valid url");
        }
    }
}
