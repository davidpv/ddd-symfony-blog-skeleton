<?php declare(strict_types=1);

namespace App\Modules\Users\Domain;

use Shared\Domain\Bus\Query\Query;
use Symfony\Component\HttpFoundation\Request;

class ListUsersQuery implements Query
{


    public readonly ?string $offset;
    public readonly ?string $limit;
    public readonly ?string $sort;
    public readonly ?string $username;
    public readonly ?string $email;

    public function __construct(
        ?string $offset,
        ?string $limit,
        ?string $sort,
        ?string $username,
        ?string $email
    )
    {
        $this->offset = $offset;
        $this->limit = $limit;
        $this->sort = $sort;
        $this->username = $username;
        $this->email = $email;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->query->get('offset'),
            $request->query->get('limit'),
            $request->query->get('sort'),
            $request->query->get('username'),
            $request->query->get('email')
        );
    }

}
