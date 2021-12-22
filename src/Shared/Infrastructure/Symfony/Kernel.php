<?php

declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\Symfony;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    public function registerBundles(): iterable
    {
        $contents = require $this->getConfDir().'/bundles.php';
        foreach ($contents as $class => $envs) {
            if ($envs[$this->environment] ?? $envs['all'] ?? false) {
                yield new $class();
            }
        }
    }

    private function getConfDir(): string
    {
        return dirname(__FILE__).'/config';
    }

    public function getProjectDir(): string
    {
        return dirname(__DIR__.'/../../../../../');
    }

    public function getLogDir(): string
    {
        return $this->getProjectDir().'/var/log';
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $container->addResource(new FileResource($this->getConfDir().'/bundles.php'));
        $container->setParameter('container.dumper.inline_class_loader', true);

        $loader->load($this->getConfDir().'/{packages}/*'.self::CONFIG_EXTS, 'glob');
        $loader->load($this->getConfDir().'/{packages}/'.$this->environment.'/**/*'.self::CONFIG_EXTS, 'glob');
        $loader->load($this->getConfDir().'/{services}'.self::CONFIG_EXTS, 'glob');
        $loader->load($this->getConfDir().'/{services}_'.$this->environment.self::CONFIG_EXTS, 'glob');
    }

    protected function configureRoutes(RouteCollectionBuilder $routes): void
    {
        $routes->import(
            $this->getConfDir().'/{routes}/'.$this->environment.'/**/*'.self::CONFIG_EXTS,
            '/',
            'glob'
        );
        $routes->import($this->getConfDir().'/{routes}/*'.self::CONFIG_EXTS, '/', 'glob');
        $routes->import($this->getConfDir().'/{routes}'.self::CONFIG_EXTS, '/', 'glob');
    }
}
