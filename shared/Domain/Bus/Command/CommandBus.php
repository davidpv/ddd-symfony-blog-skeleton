<?php

declare(strict_types=1);

namespace Shared\Domain\Bus\Command;

use Shared\Domain\Bus\Command\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}
