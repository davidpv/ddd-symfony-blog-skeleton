<?php declare(strict_types=1);

namespace Shared\Domain\Criteria;


use Shared\Domain\Collection;
use Shared\Domain\Criteria\Filter;

class FilterCollection extends Collection
{

    protected array $items;

    protected function type(): string
    {
        return \Shared\Domain\Criteria\Filter::class;
    }
}