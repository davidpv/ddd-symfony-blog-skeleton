<?php

namespace App\Modules\Users\Domain;

use App\Modules\Roles\Domain\Role;
use App\Modules\Roles\Domain\RoleCollection;
use Shared\Domain\Aggregate\AggregateRoot;
use Shared\Domain\ValueObject\DateTimeValueObject;
use Shared\Domain\ValueObject\EmailValueObject;
use Shared\Domain\ValueObject\UuidValueObject;

class User extends AggregateRoot
{

    private RoleCollection $roles;
    private bool $enabled;
    private DateTimeValueObject $createdAt;

    public function __construct(
        private UuidValueObject  $id,
        private string           $username,
        private EmailValueObject $email,
        private string           $firstName,
        private string           $lastName)
    {
        $this->roles = new RoleCollection();
        $this->enabled = true;
        $this->createdAt = DateTimeValueObject::now();
    }

    public static function create(
        string $username,
        string $email,
        string $firstName,
        string $lastName
    ): self
    {
        $user = new self(
            UuidValueObject::generate(),
            $username,
            EmailValueObject::create($email),
            $firstName,
            $lastName
        );

        $user->record(UserCreatedEvent::from($user));

        return $user;
    }

    /**
     * @return DateTimeValueObject
     */
    public function getCreatedAt(): DateTimeValueObject
    {
        return $this->createdAt;
    }

    /**
     * @param UuidValueObject $id
     */
    public function setId(UuidValueObject $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param EmailValueObject $email
     */
    public function setEmail(EmailValueObject $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function disable(): void
    {
        $this->enabled = false;
        $this->record(UserDisabledEvent::from($this));
    }

    public function enable(): void
    {
        $this->enabled = true;
        $this->record(UserEnabledEvent::from($this));
    }

    /**
     * @return UuidValueObject
     */
    public function getId(): UuidValueObject
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return EmailValueObject
     */
    public function getEmail(): EmailValueObject
    {
        return $this->email;
    }

    /**
     * @return RoleCollection
     */
    public function getRoles(): RoleCollection
    {
        return $this->roles;
    }

    public function addRole(Role $role): void
    {
        $this->roles->add($role);
    }

}
