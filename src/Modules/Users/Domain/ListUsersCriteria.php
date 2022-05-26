<?php declare(strict_types=1);

namespace App\Modules\Users\Domain;

class ListUsersCriteria extends \Shared\Domain\Criteria\Criteria
{

    public function getAllowedFields(): array
    {
        return [
            'username',
            'email'
        ];
    }
}
