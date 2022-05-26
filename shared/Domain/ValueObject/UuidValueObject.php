<?php declare(strict_types=1);

namespace Shared\Domain\ValueObject;

use InvalidArgumentException;
use Stringable;
use Symfony\Component\Uid\Uuid;

final class UuidValueObject implements ValueObject, Stringable
{

    private const VALID_PATTERN = '\A[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}\z';
    private const NIL = '00000000-0000-0000-0000-000000000000';
    private string $value;

    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    private function validate(string $value): void
    {
        $uuid = str_replace(['urn:', 'uuid:', 'URN:', 'UUID:', '{', '}'], '', $value);

        $valid = $uuid === self::NIL || preg_match('/' . self::VALID_PATTERN . '/Dms', $uuid);

        if (!$valid) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $value));
        }
    }

    public static function createFromString(string $value): self
    {
        return new self($value);
    }

    public static function generate(): self
    {
        return new self(Uuid::v4()->toRfc4122());
    }

    public function __toString()
    {
        return $this->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isTheSameAs($object): bool
    {
        return ($object instanceof self) &&
            ($object->getValue() === $this->getValue());
    }
}
