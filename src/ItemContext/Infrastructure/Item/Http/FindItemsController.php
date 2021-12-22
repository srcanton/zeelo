<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Infrastructure\Item\Http;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Zeelo\Shared\Application\Service\ServiceResponseInterface;
use Zeelo\Shared\Infrastructure\EventListener\ExceptionsHttpStatusCodeMapping;
use Zeelo\Shared\Infrastructure\Messaging\QueryBusInterface;
use Zeelo\Shared\Infrastructure\Symfony\Controller\AbstractController;
use Zeelo\Shared\Infrastructure\Http\JsonResponse;
use Zeelo\ItemContext\Application\Item\Query\FindItemsQuery;

class FindItemsController extends AbstractController
{

    public function __construct(
        ExceptionsHttpStatusCodeMapping $handler,
        private QueryBusInterface $queryBus
    ) {
        parent::__construct($handler);
    }

    public function __invoke(Request $request): JsonResponse
    {
        $body['count'] = $request->get('count') ? (int) $request->get('count') : null;
        $body['offset'] = $request->get('offset') ? (int) $request->get('offset') : null;
        $this->ensureRequestIsValid($body, $this->constraints());
        /** @var ServiceResponseInterface $items */
        $items = $this->queryBus->ask(
            new FindItemsQuery(
                $body['count'],
                $body['offset'],
            )
        );
        return new JsonResponse($items->__toArray());
    }

    private function constraints(): array
    {
        return [
            'count' => [
                new Assert\Optional(new Assert\Type('integer')),
            ],
            'offset' => [
                new Assert\Optional(new Assert\Type('integer')),
            ],
        ];
    }

    protected function exceptions(): array
    {
        return [
            InvalidArgumentException::class => Response::HTTP_BAD_REQUEST
        ];
    }
}
