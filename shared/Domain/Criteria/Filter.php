<?php

declare(strict_types=1);

namespace Shared\Domain\Criteria;

use Shared\Domain\Criteria\FilterField;
use Shared\Domain\Criteria\FilterOperator;
use Shared\Domain\Criteria\FilterValue;

final class Filter
{
    public function __construct(
        private \Shared\Domain\Criteria\FilterField    $field,
        private \Shared\Domain\Criteria\FilterOperator $operator,
        private \Shared\Domain\Criteria\FilterValue    $value
    ) {
    }

    public static function fromValues(array $values): self
    {
        return new self(
            new \Shared\Domain\Criteria\FilterField($values['field']),
            new \Shared\Domain\Criteria\FilterOperator($values['operator']),
            new \Shared\Domain\Criteria\FilterValue($values['value'])
        );
    }

    public function getField(): \Shared\Domain\Criteria\FilterField
    {
        return $this->field;
    }

    public function getOperator(): FilterOperator
    {
        return $this->operator;
    }

    public function getValue(): \Shared\Domain\Criteria\FilterValue
    {
        return $this->value;
    }

    public function serialize(): string
    {
        return sprintf('%s.%s.%s', $this->field->value(), $this->operator->value(), $this->value->value());
    }
}
