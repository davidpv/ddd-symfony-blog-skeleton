<?php declare(strict_types=1);

namespace Shared\Infrastructure\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Shared\Domain\ValueObject\UuidValueObject;

class UuidDbalType extends Type
{

    private const NAME = 'uuid';

    /**
     * @param UuidValueObject $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return (string)$value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UuidValueObject
    {
        return UuidValueObject::createFromString($value);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'VARCHAR(36)';
    }

    public function getName(): string
    {
        return self::NAME;
    }
}