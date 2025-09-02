<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class ProjectsHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface $renderer
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $githubRepoData = $request->getAttribute('github-repo-data');
        return new HtmlResponse($this->renderer->render(
            'app::projects',
            ['data' => $githubRepoData]
        ));
    }
}
