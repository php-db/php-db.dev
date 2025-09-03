<?php

declare(strict_types=1);

namespace App;

final class GithubRequestSpecProvider
{
    public function __invoke(): array
    {
        return [
            Endpoint::Repo->value => $this->getRepoRequestConfig(),
        ];
    }

    public function getRepoRequestConfig(): array
    {
        return [
            'base_uri' => 'https://api.github.com/orgs/php-db/',
        ];
    }

    public function getExcludedRepos(): array
    {
        return [
            '.github',
            'php-db.dev',
            'docs.php-db.dev',
            'discussions',
        ];
    }
}
