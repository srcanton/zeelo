<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Application\Item\Service;


use Zeelo\ItemContext\Application\Item\Service\Response\ItemResponse;
use Zeelo\Shared\Application\Service\ServiceResponseInterface;

class GetItemResponseServiceHandler
{
    public function __construct()
    {
    }

    public function handle(GetItemResponseService $service): ServiceResponseInterface
    {
        return new ItemResponse($service->item());
    }
}
