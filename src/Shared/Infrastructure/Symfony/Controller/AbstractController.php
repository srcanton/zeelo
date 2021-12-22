<?php

declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\Symfony\Controller;

use InvalidArgumentException;
use JsonSchema\Exception\JsonDecodingException;
use Zeelo\Shared\Infrastructure\EventListener\ExceptionsHttpStatusCodeMapping;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validation;

abstract class AbstractController extends SymfonyAbstractController
{
    private ExceptionsHttpStatusCodeMapping $exceptionHandler;

    public function __construct(ExceptionsHttpStatusCodeMapping $handler)
    {
        $this->exceptionHandler = $handler;
        foreach ($this->exceptions() as $exception => $httpCode) {
            $this->exceptionHandler->register($exception, $httpCode);
        }
    }

    abstract protected function exceptions(): array;

    protected function ensureRequestIsValid(?array $input, array $constraints): void
    {
        if (is_null($input)) {
            throw new JsonDecodingException();
        }
        $validator = Validation::createValidator();
        $constraint = new Collection($constraints);
        $violations = $validator->validate($input, $constraint);
        if ($violations->count() > 0) {
            throw new InvalidArgumentException(
                <<<MESSAGE
{$violations[0]->getPropertyPath()}: {$violations[0]->getMessage()} {$violations[0]->getInvalidValue()}
MESSAGE
            );
        }
    }
}
