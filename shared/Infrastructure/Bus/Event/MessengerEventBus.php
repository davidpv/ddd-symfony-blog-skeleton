<?php declare(strict_types=1);

namespace Shared\Infrastructure\Bus\Event;

use Shared\Domain\Bus\Event\EventBus;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerEventBus implements EventBus
{


    public function __construct(private MessageBusInterface $eventBus)
    {
    }

    public function publish(array $events): void
    {
        foreach ($events as $event) {
            try {
                $this->eventBus->dispatch($event);
            } catch (NoHandlerForMessageException) {
            }
        }
    }
}