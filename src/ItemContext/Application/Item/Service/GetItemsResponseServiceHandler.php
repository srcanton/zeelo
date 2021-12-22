<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Application\Item\Service;


use Zeelo\ItemContext\Application\Item\Service\Response\ItemsResponse;
use Zeelo\Shared\Application\Service\ServiceResponseInterface;

class GetItemsResponseServiceHandler
{
    public function __construct()
    {
    }

    public function handle(GetItemsResponseService $service): ServiceResponseInterface
    {
        return new ItemsResponse($service->items());
    }
}
