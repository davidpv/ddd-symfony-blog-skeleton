<?php declare(strict_types=1);

namespace App\Modules\Users\Application\CreateUser;

use Psr\Log\LoggerInterface;
use Shared\Domain\Bus\Event\DomainEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

class SendWelcomeEmailOnUserCreated implements MessageSubscriberInterface
{
    public function __construct(private LoggerInterface $logger, private MailerInterface $mailer)
    {
    }

    public function __invoke(DomainEvent $domainEvent)
    {
        $this->logger->debug(get_class($domainEvent));
    }

    public static function getHandledMessages(): iterable
    {
        yield DomainEvent::class => [
            'from_transport' => 'sync',
        ];
    }
}
