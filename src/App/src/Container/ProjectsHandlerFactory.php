<?php

declare(strict_types=1);

namespace App\Container;

use App\Handler\ProjectsHandler;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ProjectsHandlerFactory
{
    public function __invoke(ContainerInterface $container): ProjectsHandler
    {
        return new ProjectsHandler($container->get(TemplateRendererInterface::class));
    }
}
