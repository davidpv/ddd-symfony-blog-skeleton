<?php declare(strict_types=1);

namespace App\Apps\Api\Posts;

use App\Modules\Posts\Domain\ListPostsQuery;
use Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class ListPostController extends AbstractController
{

    public function __construct(private QueryBus $queryBus)
    {
    }


    public function __invoke(Request $request): JsonResponse
    {
        $query = ListPostsQuery::fromRequest($request);

        $response = $this->queryBus->handle($query);

        $defaultContext = [AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
            return ($object->getId()) ?: $object;
        }];

        return $this->json($response, context: $defaultContext);
    }
}
