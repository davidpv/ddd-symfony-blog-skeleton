<?php declare(strict_types=1);

namespace App\Modules\Posts\Domain;

use Shared\Domain\Collection;

class CommentCollection extends Collection
{

    protected function type(): string
    {
        return Comment::class;
    }
}
