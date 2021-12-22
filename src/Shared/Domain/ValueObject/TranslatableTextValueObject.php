<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain\ValueObject;

abstract class TranslatableTextValueObject
{
    protected $value;
    private $translations;

    public function __construct(array $translations)
    {
        $this->translations = $translations;
        foreach ($translations as $lang => $translation) {
            if (empty($translation) === false) {
                $this->value = $translation;
                break;
            }
        }
    }

    public function translations(): array
    {
        return $this->translations;
    }

    public function __toString(): string
    {
        return $this->value ?? '';
    }
}
