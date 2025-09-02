<?php

declare(strict_types=1);

namespace App\Container;

use App\Container\HttpClientFactoryFactory;
use App\Middleware\GithubRepoDataMiddleware;
use Psr\Container\ContainerInterface;

class GithubRepoDataMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : GithubRepoDataMiddleware
    {
        return new GithubRepoDataMiddleware(
            $container->get(HttpClientFactoryFactory::class),
            $container->get('config')
        );
    }
}
