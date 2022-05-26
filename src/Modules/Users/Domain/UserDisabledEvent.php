<?php declare(strict_types=1);

namespace App\Modules\Users\Domain;

use Shared\Domain\Aggregate\AggregateRoot;
use Shared\Domain\Bus\Event\DomainEvent;
use Shared\Domain\ValueObject\UuidValueObject;

class UserDisabledEvent extends DomainEvent
{

    public function __construct(
        UuidValueObject $aggregate,
        private string  $username,
        private string  $firstName,
        private string  $lastName,
        private string  $email
    )
    {
        parent::__construct($aggregate->getValue());
    }

    public static function from(AggregateRoot $aggregate): DomainEvent
    {
        return new self(
            $aggregate->getId(),
            $aggregate->getUsername(),
            $aggregate->getFirstName(),
            $aggregate->getLastName(),
            $aggregate->getEmail()->getFullAddress()
        );
    }

    public static function eventName(): string
    {
        return 'user.disabled';
    }

    public function to(): array
    {
        return [
            'username' => $this->username,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email
        ];
    }
}
