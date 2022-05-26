<?php declare(strict_types=1);

namespace App\Modules\Posts\Domain;

use Shared\Domain\Criteria\Criteria;

class PostCriteria extends Criteria
{

    public function getAllowedFields(): array
    {
        return [
            'author',
            'tile'
        ];
    }
}
