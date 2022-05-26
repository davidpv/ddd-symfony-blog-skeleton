<?php declare(strict_types=1);

namespace App\Modules\Users\Infrastructure\Repositories;

use App\Modules\Roles\Domain\Role;
use App\Modules\Roles\Domain\RoleName;
use App\Modules\Users\Application\ListUser\UserGetByResponse;
use App\Modules\Users\Domain\User;
use App\Modules\Users\Domain\UserCollection;
use App\Modules\Users\Domain\UserRepository;
use Shared\Domain\Criteria\Criteria;
use Shared\Domain\Criteria\FilterOperator;
use Shared\Domain\ValueObject\UuidValueObject;
use Shared\Infrastructure\Persistence\Faker\FakerRepository;
use function Lambdish\Phunctional\filter;

class InMemoryUserRepository extends FakerRepository implements UserRepository
{

    private const LIMIT = 15;

    public function getById(UuidValueObject $id): User
    {
        return self::createUser();
    }

    private static function createUser(): User
    {
        return User::create(self::$faker->userName,
            self::$faker->email,
            self::$faker->firstName,
            self::$faker->lastName);
    }

    public function getBy(Criteria $criteria): UserGetByResponse
    {
        $filteredList = [];

        $limit = ($criteria->hasPagination() && $criteria->getPagination()->getLimit()) ? $criteria->getPagination()->getLimit() : self::LIMIT;
        $offset = ($criteria->hasPagination() && $criteria->getPagination()->getOffset()) ? $criteria->getPagination()->getOffset() : 0;

        for ($i = $offset; $i < $offset + $limit; $i++) {
            $user = self::createUser();
            $user->addRole(Role::generate(RoleName::ROLE_ADMIN));
            $filteredList[] = $user;
        }

        if ($criteria->hasFilters()) {

            foreach ($criteria->getFilters(['username', 'email'], [FilterOperator::EQUAL]) as $filter) {
                $filteredList = filter(static function ($object) use ($filter) {
                    /** @var User $object */
                    return
                        ($object->getUsername() === $filter->getValue()) ||
                        ($object->getEmail() === $filter->getValue());
                }, $filteredList);
            }
        }

        return new UserGetByResponse(new UserCollection($filteredList), count($filteredList));
    }

    public function save(User $user): void
    {
        //do save
    }
}
