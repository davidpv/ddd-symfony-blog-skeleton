<?php declare(strict_types=1);

namespace Shared\Domain\Response;

class ApiQueryResponse
{

    public readonly array $items;
    public readonly int $total;

    public function __construct(array $items, int $total)
    {
        $this->items = $items;
        $this->total = $total;
    }
}