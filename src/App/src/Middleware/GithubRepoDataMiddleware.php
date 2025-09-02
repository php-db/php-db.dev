<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Endpoint;
use App\Iterator\GithubRepoResponseFilterIterator;
use ArrayIterator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function array_merge;

class GithubRepoDataMiddleware implements MiddlewareInterface
{
    private $clientFactory;

    public function __construct(
        callable $clientFactory,
        private array $config
    ) {
        $this->clientFactory = $clientFactory;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $clientConfig = array_merge($this->config[Endpoint::Repo->value], ['headers' => $this->config['headers']]);
        $client       = (($this->clientFactory)())($clientConfig);
        $response     = $client->get(Endpoint::Repo->value);
        $data         = json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $filter = new GithubRepoResponseFilterIterator(new ArrayIterator($data));
        foreach ($filter as $item) {
            $filteredData[] = $item;
        }
        $request      = $request->withAttribute('github-repo-data', $filteredData);
        return $handler->handle($request);
    }
}
