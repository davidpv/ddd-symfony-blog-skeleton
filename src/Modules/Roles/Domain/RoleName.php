<?php declare(strict_types=1);

namespace App\Modules\Roles\Domain;

enum RoleName: string
{

    case ROLE_ADMIN = 'admin';
    case ROLE_ROOT = 'root';
    case ROLE_USER = 'user';
    case ROLE_SWITCH_USER = 'allowed_to_switch';

}

//class RoleName
//{
//
//    public function __construct(string $value)
//    {
//        $this->validate($value);
//    }
//
//    private function validate($value): void
//    {
//        $valid =  ($value instanceof RoleType);
//        if (!$valid) {
//            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $value));
//        }
//    }
//
//    public static function generate(string $name): RoleName
//    {
//        return new self($name);
//    }
//
//}
