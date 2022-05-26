<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Symfony;

use Shared\Domain\Bus\Command\Command;
use Shared\Domain\Bus\Command\CommandBus;
use Shared\Domain\Bus\Query\Query;
use Shared\Domain\Bus\Query\QueryBus;
use Shared\Domain\Bus\Query\QueryResponse;
use function Lambdish\Phunctional\each;

abstract class ApiController
{
    public function __construct(
        protected QueryBus                 $queryBus,
        protected CommandBus               $commandBus,
        ApiExceptionsHttpStatusCodeMapping $exceptionHandler
    )
    {
        each(
            fn(int $httpCode, string $exceptionClass) => $exceptionHandler->register($exceptionClass, $httpCode),
            $this->exceptions()
        );
    }

    abstract protected function exceptions(): array;

    protected function ask(Query $query): ?QueryResponse
    {
        return $this->queryBus->ask($query);
    }

    protected function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
