<?php declare(strict_types=1);

namespace App\Modules\Roles\Domain;

use Shared\Domain\Collection;

class RoleCollection extends Collection
{

    protected function type(): string
    {
        return Role::class;
    }
}
