<?php
declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\Http;

use Symfony\Component\HttpFoundation\Response;
use Zeelo\Shared\Infrastructure\EventListener\ExceptionsHttpStatusCodeMapping;
use Zeelo\Shared\Infrastructure\Symfony\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class HealthController extends AbstractController
{
    private ParameterBagInterface $params;

    public function __construct(
        ExceptionsHttpStatusCodeMapping $handler,
        ParameterBagInterface $params
    ) {
        $this->params = $params;
        parent::__construct($handler);
    }

    public function __invoke(): JsonResponse
    {
        $payload = [
            'name' => $this->params->get('service_name'),
            'version' => $this->params->get('service_version'),
            'owner' => $this->params->get('service_owner'),
            'dockerNode' => gethostname(),
        ];

        return new JsonResponse($payload);
    }

    protected function exceptions(): array
    {
        return [
            \Exception::class => Response::HTTP_NOT_FOUND,
        ];
    }
}
