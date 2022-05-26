<?php declare(strict_types=1);

namespace App\Apps\Web\Users;

use App\Modules\Users\Domain\ListUsersQuery;
use Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListUserController extends AbstractController
{

    public function __construct(private QueryBus $bus)
    {
    }

    public function __invoke(Request $request): Response
    {
        $query = ListUsersQuery::fromRequest($request);

        $response = $this->bus->handle($query);

        return $this->render('web/users/user.list.html.twig', compact('response'));
    }

}
