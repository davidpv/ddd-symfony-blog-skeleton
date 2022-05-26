<?php declare(strict_types=1);

namespace App\Modules\Posts\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Shared\Domain\Aggregate\AggregateRoot;
use Shared\Domain\ValueObject\DateTimeValueObject;
use Shared\Domain\ValueObject\UuidValueObject;

class Post extends AggregateRoot
{

    private Collection $comments;
    private DateTimeValueObject $createdAt;
    private int $totalComments;

    public function __construct(
        private UuidValueObject $id,
        private UuidValueObject $userId,
        private string          $title,
        private string          $content
    )
    {
        $this->comments = new ArrayCollection();
        $this->createdAt = DateTimeValueObject::now();
        $this->totalComments = 0;
    }

    public static function create(UuidValueObject $userId, string $title, string $content): self
    {
        $post = new self(UuidValueObject::generate(), $userId, $title, $content);

        $post->record(PostCreatedEvent::from($post));

        return $post;
    }

    /**
     * @return int
     */
    public function getTotalComments(): int
    {
        return $this->totalComments;
    }

    /**
     * @return DateTimeValueObject
     */
    public function getCreatedAt(): DateTimeValueObject
    {
        return $this->createdAt;
    }

    /**
     * @return UuidValueObject
     */
    public function getId(): UuidValueObject
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    public function getComments(): ArrayCollection|Collection
    {
        return $this->comments;
    }

    public function addComment(string $body, UuidValueObject $userId): Comment
    {
        $comment = Comment::create($this, $userId, $body);
        $comment->publish();

        $this->comments->add($comment);

        ++$this->totalComments;

        return $comment;
    }

    public function removeComment(Comment $comment): void
    {
        if ($this->comments->contains($comment)){
            $this->comments->removeElement($comment);
            --$this->totalComments;
        }
    }

    /**
     * @return UuidValueObject
     */
    public function getUserId(): UuidValueObject
    {
        return $this->userId;
    }

}
