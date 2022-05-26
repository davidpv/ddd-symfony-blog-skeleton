<?php

namespace App\Tests\Users\Domain\Models;

use App\Modules\Roles\Domain\Role;
use App\Modules\Roles\Domain\RoleName;
use App\Modules\Users\Domain\User;
use PHPUnit\Framework\TestCase;
use Shared\Domain\Bus\Event\DomainEvent;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function and_event_is_thrown_when_user_created(): void
    {
        $user = User::create('someUsername', 'someemail@somemail.com', 'name', 'lastName');
        $this->assertIsArray($user->pullDomainEvents());
        $this->assertContainsOnlyInstancesOf(DomainEvent::class, $user->pullDomainEvents());
    }

    /**
     * @test
     */
    public function you_can_create_user_with_valid_email(): void
    {
        $user = User::create('someUsername', 'someemail@somemail.com', 'name', 'lastName');
        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * @test
     */
    public function you_get_exception_when_invalid_email(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        User::create('someUsername', 'someEmail', 'name', 'lastName');
    }

    /**
     * @test
     */
    public function you_get_exception_when_empty_email(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        User::create('someUsername', '', 'name', 'lastName');
    }

    /**
     * @test
     */
    public function pristine_user_has_no_roles(): void
    {
        $user = User::create('someUsername', 'someemail@somemail.com', 'name', 'lastName');
        $this->assertCount(0, $user->getRoles());
    }

    /**
     * @test
     */
    public function you_can_add_a_role_to_a_user(): void
    {
        $user = User::create('someUsername', 'someemail@somemail.com', 'name', 'lastName');
        $role = Role::generate(RoleName::ROLE_ADMIN);
        $user->addRole($role);
        $this->assertCount(1, $user->getRoles());
    }

    /**
     * @test
     */
    public function you_can_disable_a_user(): void
    {
        $user = User::create('someUsername', 'someemail@somemail.com', 'name', 'lastName');
        $user->disable();
        $this->assertFalse($user->isEnabled());
    }


}
