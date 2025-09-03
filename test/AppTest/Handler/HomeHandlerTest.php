<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\HomeHandler;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

final class HomeHandlerTest extends TestCase
{
    /** @var ServerRequestInterface&MockObject */
    protected $request;

    /** @var TemplateRendererInterface&MockObject */
    protected $renderer;

    protected function setUp(): void
    {
        $this->request  = $this->createMock(ServerRequestInterface::class);
        $this->renderer = $this->createMock(TemplateRendererInterface::class);
    }

    public function testReturnsJsonResponseWhenNoTemplateRendererProvided(): void
    {
        $homePage = new HomeHandler(
            null
        );
        $response = $homePage->handle(
            $this->request
        );

        self::assertInstanceOf(JsonResponse::class, $response);
    }

    public function testReturnsHtmlResponseWhenTemplateRendererProvided(): void
    {
        /** @var TemplateRendererInterface&MockObject $renderer */
        $renderer = $this->createMock(TemplateRendererInterface::class);
        $renderer
            ->expects($this->once())
            ->method('render')
            ->with('app::home', $this->isType('array'))
            ->willReturn('');

        $homePage = new HomeHandler(
            $renderer
        );

        $response = $homePage->handle(
            $this->request
        );

        self::assertInstanceOf(HtmlResponse::class, $response);
    }
}
