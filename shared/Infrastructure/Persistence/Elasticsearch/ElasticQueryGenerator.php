<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Persistence\Elasticsearch;

use Shared\Domain\Criteria\Filter;
use Shared\Domain\Criteria\FilterOperator;
use Exception;

final class ElasticQueryGenerator
{
    private const MUST_TYPE     = 'must';
    private const MUST_NOT_TYPE = 'must_not';
    private const TERM_TERM     = 'term';
    private const TERM_RANGE    = 'range';
    private const TERM_WILDCARD = 'wildcard';

    private static array $mustNotFields = [FilterOperator::NOT_EQUAL, FilterOperator::NOT_CONTAINS];

    public function __invoke(array $query, Filter $filter): array
    {
        $type          = $this->typeFor($filter->getOperator());
        $termLevel     = $this->termLevelFor($filter->getOperator());
        $valueTemplate = $filter->getOperator()->isContaining() ? '*%s*' : '%s';

        return array_merge_recursive(
            $query,
            [
                $type => [
                    $termLevel => [
                        $filter->getField()->value() => sprintf(
                            $valueTemplate,
                            strtolower($filter->getValue()->value())
                        ),
                    ],
                ],
            ]
        );
    }

    private function typeFor(FilterOperator $operator): string
    {
        return in_array($operator->value(), self::$mustNotFields, true) ? self::MUST_NOT_TYPE : self::MUST_TYPE;
    }

    private function termLevelFor(FilterOperator $operator): string
    {
        return match ($operator->value()) {
            FilterOperator::EQUAL                                  => self::TERM_TERM,
            FilterOperator::NOT_EQUAL                              => '!=',
            FilterOperator::GT, FilterOperator::LT                 => self::TERM_RANGE,
            FilterOperator::CONTAINS, FilterOperator::NOT_CONTAINS => self::TERM_WILDCARD,
            default => throw new Exception("Unexpected match value {$operator->value()}"),
        };
    }
}
