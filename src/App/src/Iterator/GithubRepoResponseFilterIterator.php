<?php

declare(strict_types=1);

namespace App\Iterator;

use App\GithubRequestSpecProvider;
use FilterIterator;
use Iterator;

use function str_contains;

final class GithubRepoResponseFilterIterator extends FilterIterator
{
    private string $nameNeedle = 'laminas';

    public function __construct(Iterator $iterator)
    {
        parent::__construct($iterator);
    }

    public function accept(): bool
    {
        $provider = new GithubRequestSpecProvider();
        $current  = $this->getInnerIterator()->current();
        return ! str_contains($current['name'], $this->nameNeedle) && ! in_array($current['name'], $provider->getExcludedRepos(), true);
    }
}
