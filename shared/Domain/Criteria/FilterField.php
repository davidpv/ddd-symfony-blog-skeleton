<?php

declare(strict_types=1);

namespace Shared\Domain\Criteria;

use Shared\Domain\ValueObject\StringValueObject;

final class FilterField extends StringValueObject
{
    public static function from(string $value): self
    {
        return new self($value);
    }
}
