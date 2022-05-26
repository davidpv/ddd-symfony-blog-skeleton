<?php

declare(strict_types=1);

namespace Shared\Domain\Criteria;

use Shared\Domain\Criteria\OrderBy;
use Shared\Domain\Criteria\OrderType;

final class Order
{
    public function __construct(private \Shared\Domain\Criteria\OrderBy $orderBy, private OrderType $orderType)
    {
    }

    public static function createDesc(\Shared\Domain\Criteria\OrderBy $orderBy): Order
    {
        return new self($orderBy, \Shared\Domain\Criteria\OrderType::desc());
    }

    public static function fromValues(?string $orderBy, ?string $order): Order
    {
        return null === $orderBy ? self::none() : new Order(new \Shared\Domain\Criteria\OrderBy($orderBy), new \Shared\Domain\Criteria\OrderType($order));
    }

    public static function none(): Order
    {
        return new Order(new \Shared\Domain\Criteria\OrderBy(''), \Shared\Domain\Criteria\OrderType::none());
    }

    public function orderBy(): \Shared\Domain\Criteria\OrderBy
    {
        return $this->orderBy;
    }

    public function orderType(): \Shared\Domain\Criteria\OrderType
    {
        return $this->orderType;
    }

    public function isNone(): bool
    {
        return $this->orderType()->isNone();
    }

    public function serialize(): string
    {
        return sprintf('%s.%s', $this->orderBy->value(), $this->orderType->value());
    }
}
