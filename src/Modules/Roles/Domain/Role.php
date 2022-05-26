<?php declare(strict_types=1);

namespace App\Modules\Roles\Domain;

use Shared\Domain\ValueObject\UuidValueObject;

class Role
{

    public readonly UuidValueObject $id;
    public readonly RoleName $name;

    public function __construct(UuidValueObject $id, RoleName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function generate(RoleName $name): Role
    {
        return new self(UuidValueObject::generate(), $name);
    }
}
