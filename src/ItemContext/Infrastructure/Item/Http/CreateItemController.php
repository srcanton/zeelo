<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Infrastructure\Item\Http;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use Zeelo\ItemContext\Domain\Item\Exception\ItemAlreadyExists;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Domain\Exception\NotValidUrl;
use Zeelo\Shared\Infrastructure\EventListener\ExceptionsHttpStatusCodeMapping;
use Zeelo\Shared\Infrastructure\Messaging\CommandBusInterface;
use Zeelo\Shared\Infrastructure\Symfony\Controller\AbstractController;
use Zeelo\Shared\Infrastructure\Http\JsonResponse;
use Zeelo\ItemContext\Application\Item\Command\CreateItemCommand;


class CreateItemController extends AbstractController
{

    public function __construct(
        ExceptionsHttpStatusCodeMapping $handler,
        private CommandBusInterface $commandBus
    ) {
        parent::__construct($handler);
    }

    /**
     * @throws InvalidUuid
     * @throws NotValidUrl
     */
    public function __invoke(Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);
        $this->ensureRequestIsValid($body, $this->constraints());

        $this->commandBus->handle(
            new CreateItemCommand(
                $body['id'],
                $body['image'] ?? null,
                $body['title'] ?? null,
                $body['author'] ?? null,
                isset($body['price']) ? (float)$body['price'] : null,
            )
        );
        return new JsonResponse([], Response::HTTP_CREATED);
    }

    private function constraints(): array
    {
        return [
            'id' => [
                new Assert\Uuid(),
            ],
            'image' => [
                new Assert\Optional(new Assert\Url()),
            ],
            'title' => [
                new Assert\Optional(new Assert\Type('string')),
            ],
            'author' => [
                new Assert\Optional(new Assert\Type('string')),
            ],
            'price' => [
                new Assert\Optional(new Assert\Type('float')),
            ],
        ];
    }

    protected function exceptions(): array
    {
        return [
            InvalidArgumentException::class => Response::HTTP_BAD_REQUEST,
            InvalidUuid::class => Response::HTTP_BAD_REQUEST,
            NotValidUrl::class => Response::HTTP_BAD_REQUEST,
            ItemAlreadyExists::class => Response::HTTP_CONFLICT,
        ];
    }
}
