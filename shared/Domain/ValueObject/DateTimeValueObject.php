<?php declare(strict_types=1);

namespace Shared\Domain\ValueObject;

class DateTimeValueObject implements ValueObject
{

    private const DATABASE_FORMAT = 'Y-m-d h:i:s';
    private \DateTime $dateTime;

    public function __construct(\DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public static function createFromString(string $value): self
    {
        return new self(new \DateTime($value));
    }

    public static function createFromDatetime(\DateTime $value): self
    {
        return new self($value);
    }

    public static function now(): self
    {
        return self::createFromString('now');
    }

    public function __toString()
    {
        return $this->getValue();
    }

    public function getValue()
    {
        return $this->dateTime->format(self::DATABASE_FORMAT);
    }

    public function isTheSameAs($object): bool
    {
        return $object === $this->getValue();
    }


}