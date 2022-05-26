<?php declare(strict_types=1);

namespace App\Modules\Posts\Domain;

use Shared\Domain\Bus\Query\Query;
use Symfony\Component\HttpFoundation\Request;

class ListPostsQuery implements Query
{
    public readonly ?string $offset;
    public readonly ?string $limit;
    public readonly ?string $sort;
    public readonly ?string $title;

    public function __construct(
        ?string $offset,
        ?string $limit,
        ?string $sort,
        ?string $title
    )
    {
        $this->offset = $offset;
        $this->limit = $limit;
        $this->sort = $sort;
        $this->title = $title;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->query->get('offset'),
            $request->query->get('limit'),
            $request->query->get('sort'),
            $request->query->get('title')
        );
    }
}
