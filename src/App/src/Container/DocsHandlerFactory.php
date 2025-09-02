<?php

declare(strict_types=1);

namespace App\Container;

use App\Handler\DocsHandler;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class DocsHandlerFactory
{
    public function __invoke(ContainerInterface $container) : DocsHandler
    {
        return new DocsHandler($container->get(TemplateRendererInterface::class));
    }
}
