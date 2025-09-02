<?php

declare(strict_types=1);

namespace App\Container;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\StreamHandler;

final class HttpClientFactoryFactory
{
    public function __invoke(): callable
    {
        return static function (?array $config = null, bool $stream = true): Client {
            if ($stream) {
                $handler = HandlerStack::create(new StreamHandler());
                $config = $config ? array_merge($config, ['handler' => $handler]) : ['handler' => $handler];
            }
            return empty($config) ? new Client() : new Client($config);
        };
    }
}
