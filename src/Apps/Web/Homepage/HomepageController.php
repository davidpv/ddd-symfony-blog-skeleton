<?php declare(strict_types=1);

namespace App\Apps\Web\Homepage;

use App\Modules\Posts\Domain\ListPostsQuery;
use Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AbstractController
{

    public function __construct(private QueryBus $bus)
    {
    }

    public function __invoke(Request $request): Response
    {
        $query = ListPostsQuery::fromRequest($request);

        $response = $this->bus->handle($query);

        return $this->render('web/homepage/index.html.twig', compact('response'));

    }

}
