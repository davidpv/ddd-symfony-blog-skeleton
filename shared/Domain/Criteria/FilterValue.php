<?php

declare(strict_types=1);

namespace Shared\Domain\Criteria;

use Shared\Domain\ValueObject\StringValueObject;

final class FilterValue extends StringValueObject
{
    public static function from(?string $value): self
    {
        $value = ($value) ?: '';
        return new self($value);
    }
}
