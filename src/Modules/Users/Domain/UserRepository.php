<?php declare(strict_types=1);

namespace App\Modules\Users\Domain;

use App\Modules\Users\Application\ListUser\UserGetByResponse;
use Shared\Domain\Criteria\Criteria;
use Shared\Domain\ValueObject\UuidValueObject;

interface UserRepository
{

    public function getById(UuidValueObject $id): User;

    public function getBy(Criteria $criteria): UserGetByResponse;

    public function save(User $user): void;

}
