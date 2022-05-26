<?php declare(strict_types=1);

namespace App\Apps\Api\Users;


use App\Modules\Users\Domain\CreateUserCommand;
use Shared\Domain\Bus\Command\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController extends AbstractController
{

    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $command = CreateUserCommand::fromRequest($request);

        $this->commandBus->dispatch($command);

        return new JsonResponse(null, Response::HTTP_CREATED);

    }

}
