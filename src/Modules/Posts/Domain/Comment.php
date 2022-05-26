<?php declare(strict_types=1);

namespace App\Modules\Posts\Domain;

use Shared\Domain\ValueObject\UuidValueObject;

class Comment
{


    private bool $published;

    public function __construct(private UuidValueObject $id,
                                private Post            $post,
                                private UuidValueObject $userId,
                                private string          $body)
    {
        $this->published = false;
    }

    public static function create(Post $post, UuidValueObject $userId, string $body): self
    {
        return new self(UuidValueObject::generate(), $post, $userId, $body);
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * @return UuidValueObject
     */
    public function getId(): UuidValueObject
    {
        return $this->id;
    }

    /**
     * @return UuidValueObject
     */
    public function getUserId(): UuidValueObject
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    public function publish(): self
    {
        $this->published = true;
        return $this;
    }

    public function unpublish(): self
    {
        $this->published = false;
        return $this;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }


}
