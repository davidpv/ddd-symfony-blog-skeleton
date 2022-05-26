<?php

declare(strict_types=1);

namespace Shared\Domain\Criteria;


use Shared\Domain\Pagination\Pagination;
use Shared\Domain\Criteria\Filter;
use Shared\Domain\Criteria\FilterCollection;

abstract class Criteria
{

    private ?FilterCollection $filterCollection;

    private ?Pagination $pagination;

    public function __construct(
        ?FilterCollection $filterCollection = null,
        ?Pagination       $pagination = null
    )
    {
        $this->filterCollection = $filterCollection;
        $this->pagination = $pagination;
        $this->validateAllowedFields();
    }

    private function validateAllowedFields()
    {
    }

    public function hasFilters(): bool
    {
        if (null !== $this->filterCollection) {
            return $this->filterCollection->count() > 0;
        }

        return false;
    }

    public function hasPagination(): bool
    {
        return null !== $this->pagination;
    }

    public function getFilters(array $fields = null, array $operators = null): ?FilterCollection
    {
        $filterList = (array) $this->filterCollection->getIterator();
        $filterListFiltered = [];

        if (!empty($fields)) {
            $filterListFiltered = array_filter(
                $filterList,
                static function ($filter) use ($fields) {
                    foreach ($fields as $field) {
                        /** @var \Shared\Domain\Criteria\Filter $filter */
                        if ($filter->getField()->value() === $field) {
                            return true;
                        }
                    }
                    return false;
                }
            );
        }

        if (!empty($operators)) {
            $filterListFiltered = array_filter(
                $filterList,
                static function ($filter) use ($operators) {
                    foreach ($operators as $operator) {
                        /** @var \Shared\Domain\Criteria\Filter $filter */
                        if ($filter->getOperator()->value() === $operator) {
                            return true;
                        }
                    }
                    return false;
                }
            );
        }

        return new \Shared\Domain\Criteria\FilterCollection(array_values($filterListFiltered));
    }

    public function getPagination(): ?Pagination
    {
        return $this->pagination;
    }

    abstract public function getAllowedFields(): array;

}
