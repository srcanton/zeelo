<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Infrastructure\Item\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zeelo\Shared\Application\Service\ServiceResponseInterface;
use Zeelo\Shared\Domain\Exception\InvalidUuid;
use Zeelo\Shared\Infrastructure\EventListener\ExceptionsHttpStatusCodeMapping;
use Zeelo\Shared\Infrastructure\Messaging\QueryBusInterface;
use Zeelo\Shared\Infrastructure\Symfony\Controller\AbstractController;
use Zeelo\Shared\Infrastructure\Http\JsonResponse;
use Zeelo\ItemContext\Application\Item\Query\FindItemQuery;
use Zeelo\ItemContext\Domain\Item\Exception\ItemNotFound;

class FindItemController extends AbstractController
{

    public function __construct(
        ExceptionsHttpStatusCodeMapping $handler,
        private QueryBusInterface $queryBus
    ) {
        parent::__construct($handler);
    }

    /**
     * @throws InvalidUuid
     */
    public function __invoke(string $id, Request $request): JsonResponse
    {
        /** @var ServiceResponseInterface $item */
        $item = $this->queryBus->ask(
            new FindItemQuery(
                $id
            )
        );
        return new JsonResponse($item->__toArray());
    }

    protected function exceptions(): array
    {
        return [
            ItemNotFound::class => Response::HTTP_NOT_FOUND
        ];
    }
}
