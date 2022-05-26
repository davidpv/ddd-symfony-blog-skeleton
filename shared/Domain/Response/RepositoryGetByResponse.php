<?php declare(strict_types=1);

namespace Shared\Domain\Response;

use Shared\Domain\Collection;

class RepositoryGetByResponse
{
    public readonly Collection $items;
    public readonly int $total;
    public readonly int $pageTotal;

    public function __construct(Collection $items, int $total)
    {
        $this->items = $items;
        $this->total = $total;
        $this->pageTotal = $items->count();
    }
}