<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Container\HomeHandlerFactory;
use App\Handler\HomeHandler;
use AppTest\InMemoryContainer;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\TestCase;

final class HomeHandlerFactoryTest extends TestCase
{
    public function testFactoryWithoutTemplate(): void
    {
        $container = new InMemoryContainer();
        $container->setService(RouterInterface::class, $this->createMock(RouterInterface::class));

        $factory  = new HomeHandlerFactory();
        $homePage = $factory($container);

        self::assertInstanceOf(HomeHandler::class, $homePage);
    }

    public function testFactoryWithTemplate(): void
    {
        $container = new InMemoryContainer();
        $container->setService(RouterInterface::class, $this->createMock(RouterInterface::class));
        $container->setService(TemplateRendererInterface::class, $this->createMock(TemplateRendererInterface::class));

        $factory  = new HomeHandlerFactory();
        $homePage = $factory($container);

        self::assertInstanceOf(HomeHandler::class, $homePage);
    }
}
