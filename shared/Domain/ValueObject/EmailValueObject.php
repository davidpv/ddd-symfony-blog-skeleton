<?php declare(strict_types=1);

namespace Shared\Domain\ValueObject;

use Shared\Domain\ValueObject\ValueObject;
use function App\Shared\Domain\ValueObject\idn_to_ascii;

final class EmailValueObject implements \Shared\Domain\ValueObject\ValueObject
{
    private string|bool $userName;
    private string|bool $domain;

    public function __construct(string $emailAddress)
    {
        $delimiter = strrpos($emailAddress, '@');
        if ($delimiter === false) {
            throw new \InvalidArgumentException('Email must contain "@" character');
        }
        $this->userName = substr($emailAddress, 0, $delimiter);
        $this->domain = substr($emailAddress, $delimiter + 1);

        if (trim($this->domain) === '') {
            throw new \InvalidArgumentException('Email domain cannot be empty');
        }

        if (trim($this->userName) === '') {
            throw new \InvalidArgumentException('Local part of email cannot be empty');
        }
    }

    public static function create(string $email): self
    {
        return new self($email);
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getNormalizedAddress(): string
    {
        return $this->userName . '@' . $this->getNormalizedDomain();
    }

    public function getNormalizedDomain(): string
    {
        return (string)idn_to_ascii($this->domain, (array)IDNA_NONTRANSITIONAL_TO_ASCII, INTL_IDNA_VARIANT_UTS46);
    }

    public function __toString(): string
    {
        return $this->getFullAddress();
    }

    public function getFullAddress(): string
    {
        return $this->userName . '@' . $this->domain;
    }

    public function getValue(): string
    {
        return $this->getFullAddress();
    }

    public function isTheSameAs($object): bool
    {
        return $object instanceof self && $object->getValue() === $this->getValue();
    }
}