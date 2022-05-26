<?php declare(strict_types=1);

namespace Shared\Domain\Pagination;


use Shared\Domain\Pagination\Sort;
use Shared\Domain\Pagination\SortCollection;

class Pagination
{
    private ?string $limit;
    private ?string $offset;
    private ?SortCollection $sort;

    public function __construct(
        ?string                                   $limit = null,
        ?string                                   $offset = null,
        ?\Shared\Domain\Pagination\SortCollection $sort = null)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->sort = $sort;
    }

    public static function create(?string $limit, ?string $offset, ?string $sort): self
    {
        $sortCollection = new SortCollection([new Sort($sort)]);
        return new self($limit, $offset, $sortCollection);
    }

    public function getLimit(): ?string
    {
        return $this->limit;
    }

    /**
     * @param string|null $limit
     */
    public function setLimit(?string $limit): void
    {
        $this->limit = $limit;
    }

    public function getOffset(): ?string
    {
        return $this->offset;
    }

    /**
     * @param string|null $offset
     */
    public function setOffset(?string $offset): void
    {
        $this->offset = $offset;
    }

    public function getSort(): ?\Shared\Domain\Pagination\SortCollection
    {
        return $this->sort;
    }

    /**
     * @param \Shared\Domain\Pagination\SortCollection|null $sort
     */
    public function setSort(?\Shared\Domain\Pagination\SortCollection $sort): void
    {
        $this->sort = $sort;
    }
}