<?php declare(strict_types=1);

namespace Shared\Domain\Pagination;

use Shared\Domain\Pagination\Sort;
use Shared\Domain\Collection;

class SortCollection extends Collection
{

    protected function type(): string
    {
        return \Shared\Domain\Pagination\Sort::class;
    }
}