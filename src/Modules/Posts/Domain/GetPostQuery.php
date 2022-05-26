<?php

namespace App\Modules\Posts\Domain;

use Shared\Domain\Bus\Query\Query;

class GetPostQuery implements Query
{
    protected string $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
