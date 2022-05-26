<?php declare(strict_types=1);

namespace Shared\Infrastructure\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Shared\Domain\ValueObject\DateTimeValueObject;

class DatetimeDbalType extends Type
{

    private const NAME = 'datetime';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        /** @var DateTimeValueObject $value */
        return $value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): DateTimeValueObject
    {
        return DateTimeValueObject::createFromString($value);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'datetime';
    }

    public function getName(): string
    {
        return self::NAME;
    }
}