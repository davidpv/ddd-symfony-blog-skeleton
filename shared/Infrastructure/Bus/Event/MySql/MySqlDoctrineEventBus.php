<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Bus\Event\MySql;

use Shared\Domain\Bus\Event\DomainEvent;
use Shared\Domain\Bus\Event\EventBus;
use Shared\Domain\Utils;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use function Lambdish\Phunctional\each;

final class MySqlDoctrineEventBus implements EventBus
{
    private const DATABASE_TIMESTAMP_FORMAT = 'Y-m-d H:i:s';
    private Connection $connection;

    public function __construct(EntityManager $entityManager)
    {
        $this->connection = $entityManager->getConnection();
    }

    public function publish(array $events): void
    {
        each($this->publisher(), $events);
    }

    private function publisher(): callable
    {
        return function (DomainEvent $domainEvent): void {
            $id          = $this->connection->quote($domainEvent->eventId());
            $aggregateId = $this->connection->quote($domainEvent->aggregateId());
            $name        = $this->connection->quote($domainEvent::eventName());
            $body        = $this->connection->quote(Utils::jsonEncode($domainEvent->to()));
            $occurredOn  = $this->connection->quote(
                Utils::stringToDate($domainEvent->occurredOn())->format(self::DATABASE_TIMESTAMP_FORMAT)
            );

            $this->connection->executeUpdate(
                <<<SQL
                INSERT INTO domain_events (id,  aggregate_id, name,  body,  occurred_on) 
                                   VALUES ($id, $aggregateId, $name, $body, $occurredOn);
SQL
            );
        };
    }
}