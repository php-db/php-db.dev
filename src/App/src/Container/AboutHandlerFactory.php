<?php

declare(strict_types=1);

namespace App\Container;

use App\Handler\AboutHandler;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AboutHandlerFactory
{
    public function __invoke(ContainerInterface $container) : AboutHandler
    {
        return new AboutHandler($container->get(TemplateRendererInterface::class));
    }
}
