<?php declare(strict_types=1);

namespace App\Modules\Posts\Domain;


use Shared\Domain\Collection;

class PostCollection extends Collection
{

    public function getItems(): array
    {
        return $this->items();
    }

    protected function type(): string
    {
        return Post::class;
    }
}
