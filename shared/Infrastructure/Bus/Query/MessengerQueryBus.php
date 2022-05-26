<?php declare(strict_types=1);

namespace Shared\Infrastructure\Bus\Query;

use Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerQueryBus implements \Shared\Domain\Bus\Query\QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(
        MessageBusInterface $queryBus,
    )
    {
        $this->messageBus = $queryBus;
    }

    public function handle($query)
    {
        return $this->handleQuery($query);
    }
}