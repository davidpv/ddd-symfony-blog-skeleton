<?php declare(strict_types=1);

namespace App\Modules\Users\Application\ListUser;


use App\Modules\Users\Domain\ListUsersCriteria;
use App\Modules\Users\Domain\ListUsersQuery;
use App\Modules\Users\Domain\UserRepository;
use Shared\Domain\Bus\Query\QueryHandler;
use Shared\Domain\Criteria\Filter;
use Shared\Domain\Criteria\FilterCollection;
use Shared\Domain\Criteria\FilterField;
use Shared\Domain\Criteria\FilterOperator;
use Shared\Domain\Criteria\FilterValue;
use Shared\Domain\Pagination\Pagination;

class ListUsersQueryHandler implements QueryHandler
{

    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(ListUsersQuery $query): UserGetByResponse
    {

        $pagination = Pagination::create($query->limit, $query->offset, $query->sort);
        $filterCollection = $this->setupFilters($query);
        $criteria = new ListUsersCriteria($filterCollection, $pagination);


        $response = $this->repository->getBy($criteria);

        return $response;
    }

    /**
     * @param \App\Modules\Users\Domain\ListUsersQuery $query
     * @return FilterCollection
     */
    private function setupFilters(ListUsersQuery $query): FilterCollection
    {
        $filterCollection = new FilterCollection([]);

        if ($query->username) {
            $filterCollection->add(
                new Filter(FilterField::from('username'), new FilterOperator(FilterOperator::EQUAL), FilterValue::from($query->username))
            );
        }
        if ($query->email) {
            $filterCollection->add(
                new Filter(FilterField::from('email'), new FilterOperator(FilterOperator::EQUAL), FilterValue::from($query->email))
            );
        }
        return $filterCollection;
    }

}
