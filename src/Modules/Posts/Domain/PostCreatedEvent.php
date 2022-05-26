<?php declare(strict_types=1);

namespace App\Modules\Posts\Domain;

use Shared\Domain\Aggregate\AggregateRoot;
use Shared\Domain\Bus\Event\DomainEvent;
use Shared\Domain\ValueObject\UuidValueObject;

final class PostCreatedEvent extends DomainEvent
{

    public function __construct(
        private UuidValueObject $aggregate,
        private UuidValueObject $userId,
        private string          $title,
        private string          $content,
    )
    {
        parent::__construct($aggregate->getValue());
    }

    public static function from(AggregateRoot $aggregate): DomainEvent
    {
        return new self(
            $aggregate->getId(),
            $aggregate->getUserId(),
            $aggregate->getTitle(),
            $aggregate->getContent()
        );
    }

    public static function eventName(): string
    {
        return 'post.created';
    }

    public function to(): array
    {
        return [
            'id' => $this->aggregate->getValue(),
            'userId' => $this->userId->getValue(),
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}
