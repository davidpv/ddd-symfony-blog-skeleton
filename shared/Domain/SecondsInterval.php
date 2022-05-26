<?php

declare(strict_types=1);

namespace Shared\Domain;

use Shared\Domain\Second;
use DomainException;

final class SecondsInterval
{
    public function __construct(private \Shared\Domain\Second $from, private Second $to)
    {
        $this->ensureIntervalEndsAfterStart($from, $to);
    }

    public static function fromValues(int $from, int $to): SecondsInterval
    {
        return new self(new \Shared\Domain\Second($from), new Second($to));
    }

    private function ensureIntervalEndsAfterStart(\Shared\Domain\Second $from, \Shared\Domain\Second $to): void
    {
        if ($from->isBiggerThan($to)) {
            throw new DomainException('To is bigger than from');
        }
    }
}
