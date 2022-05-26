<?php declare(strict_types=1);

namespace App\Modules\Users\Infrastructure\Repositories;

use App\Modules\Users\Application\ListUser\UserGetByResponse;
use App\Modules\Users\Domain\User;
use App\Modules\Users\Domain\UserCollection;
use App\Modules\Users\Domain\UserRepository;
use Shared\Domain\Criteria\Criteria;
use Shared\Domain\ValueObject\UuidValueObject;
use Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{

    public function getById(UuidValueObject $id): User
    {
        return $this->entityManager()->find(User::class, $id);
    }

    public function getBy(Criteria $criteria): UserGetByResponse
    {
        $builder = $this->entityManager()->createQueryBuilder()
            ->select('user')
            ->from(User::class, 'user');
        $query = $builder->getQuery();

        $collection = $query->getResult();


        return new UserGetByResponse(new UserCollection($collection), count($collection));
    }

    public function save(User $user): void
    {
    }
}
