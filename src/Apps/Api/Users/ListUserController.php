<?php declare(strict_types=1);

namespace App\Apps\Api\Users;

use App\Modules\Users\Domain\ListUsersQuery;
use Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListUserController extends AbstractController
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $query = ListUsersQuery::fromRequest($request);


        $response = $this->queryBus->handle($query);

        return $this->json($response);
    }
}
