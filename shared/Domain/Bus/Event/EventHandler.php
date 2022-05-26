<?php declare(strict_types=1);

namespace Shared\Domain\Bus\Event;

use Shared\Domain\Bus\Event\EventBus;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

interface EventHandler extends MessageSubscriberInterface
//interface EventHandler extends EventBus
{

}