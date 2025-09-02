<?php

declare(strict_types=1);

namespace App\Container;

use App\Handler\CommunityHandler;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CommunityHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CommunityHandler
    {
        return new CommunityHandler($container->get(TemplateRendererInterface::class));
    }
}
