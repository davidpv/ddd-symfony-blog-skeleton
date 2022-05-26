<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Bus\Event;

use Shared\Domain\Bus\Event\DomainEvent;
use Shared\Domain\Utils;
use Shared\Infrastructure\Bus\Event\DomainEventMapping;
use RuntimeException;

final class DomainEventJsonDeserializer
{
    public function __construct(private \Shared\Infrastructure\Bus\Event\DomainEventMapping $mapping)
    {
    }

    public function deserialize(string $domainEvent): \Shared\Domain\Bus\Event\DomainEvent
    {
        $eventData  = Utils::jsonDecode($domainEvent);
        $eventName  = $eventData['data']['type'];
        $eventClass = $this->mapping->for($eventName);

        if (null === $eventClass) {
            throw new RuntimeException("The event <$eventName> doesn't exist or has no subscribers");
        }

        return $eventClass::fromPrimitives(
            $eventData['data']['attributes']['id'],
            $eventData['data']['attributes'],
            $eventData['data']['id'],
            $eventData['data']['occurred_on']
        );
    }
}
