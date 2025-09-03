<?php

declare(strict_types=1);

namespace App;

final class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class                => Handler\PingHandler::class,
                Container\HttpClientFactoryFactory::class => Container\HttpClientFactoryFactory::class,
            ],
            'factories'  => [
                Handler\AboutHandler::class                => Container\AboutHandlerFactory::class,
                Handler\CommunityHandler::class            => Container\CommunityHandlerFactory::class,
                Handler\HomeHandler::class                 => Container\HomeHandlerFactory::class,
                Handler\ProjectsHandler::class             => Container\ProjectsHandlerFactory::class,
                Middleware\GithubRepoDataMiddleware::class => Container\GithubRepoDataMiddlewareFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
