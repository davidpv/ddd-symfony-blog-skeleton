<?php declare( strict_types = 1 );

namespace Shared\Domain\ValueObject;

use Shared\Domain\ValueObject\ValueObject;
use InvalidArgumentException;
use Symfony\Component\Uid\Uuid;

final class IdValueObject implements \Shared\Domain\ValueObject\ValueObject
{

    private int $value;

    public function __construct(int $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    private function validate(int $value): void
    {
        if (!is_int($value)){
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $value));
        }
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function isTheSameAs($object): bool
    {
        return ($object instanceof self) &&
            ($object->getValue() === $this->getValue());
    }
}