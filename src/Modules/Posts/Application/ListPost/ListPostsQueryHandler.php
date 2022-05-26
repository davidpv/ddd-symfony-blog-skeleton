<?php declare(strict_types=1);

namespace App\Modules\Posts\Application\ListPost;

use App\Modules\Posts\Domain\ListPostsQuery;
use App\Modules\Posts\Domain\ListPostsQueryResponse;
use App\Modules\Posts\Domain\PostCriteria;
use App\Modules\Posts\Domain\PostRepository;
use Shared\Domain\Bus\Query\QueryHandler;

class ListPostsQueryHandler implements QueryHandler
{

    public function __construct(private PostRepository $repository)
    {
    }

    public function __invoke(ListPostsQuery $query): ListPostsQueryResponse
    {
        $collection = $this->repository->getBy(new PostCriteria());

        return new ListPostsQueryResponse($collection->getItems(), $collection->count());
    }
}
