<?php declare(strict_types=1);

namespace Shared\Infrastructure\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Shared\Domain\ValueObject\EmailValueObject;

class EmailDbalType extends Type
{

    private const NAME = 'email';

    /**
     * @param EmailValueObject $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return (string)$value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): EmailValueObject
    {
        return EmailValueObject::create($value);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'VARCHAR(120)';
    }

    public function getName(): string
    {
        return self::NAME;
    }
}