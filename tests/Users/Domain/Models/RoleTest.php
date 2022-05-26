<?php

namespace App\Tests\Users\Domain\Models;

use App\Modules\Roles\Domain\RoleName;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{

    /**
     * @test
     */
    public function you_can_create_an_admin_role(): void
    {
        $role = \App\Modules\Roles\Domain\Role::generate(RoleName::ROLE_ADMIN);
        $this->assertInstanceOf(RoleName::class, $role->name);
    }


}
