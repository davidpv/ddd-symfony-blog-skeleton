<?php declare(strict_types=1);

namespace App\Modules\Users\Application\CreateUser;

use App\Modules\Users\Domain\CreateUserCommand;
use App\Modules\Users\Domain\User;
use App\Modules\Users\Domain\UserRepository;
use Shared\Domain\Bus\Command\CommandHandler;
use Shared\Domain\Bus\Event\EventBus;

class CreateUserCommandHandler implements CommandHandler
{
    public function __construct(
        private UserRepository $userRepository,
        private EventBus       $eventBus,
    )
    {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $user = User::create(
            $command->username,
            $command->email,
            $command->firstName,
            $command->lastName
        );
        $this->userRepository->save($user);

        $this->eventBus->publish($user->pullDomainEvents());
    }

}
