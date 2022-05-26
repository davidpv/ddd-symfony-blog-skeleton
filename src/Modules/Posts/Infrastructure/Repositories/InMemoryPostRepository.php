<?php declare(strict_types=1);

namespace App\Modules\Posts\Infrastructure\Repositories;

use App\Modules\Posts\Domain\Comment;
use App\Modules\Posts\Domain\Post;
use App\Modules\Posts\Domain\PostCollection;
use App\Modules\Posts\Domain\PostCriteria;
use App\Modules\Posts\Domain\PostRepository;
use Shared\Domain\ValueObject\UuidValueObject;
use Shared\Infrastructure\Persistence\Faker\FakerRepository;

class InMemoryPostRepository extends FakerRepository implements PostRepository
{

    public function getBy(PostCriteria $criteria): PostCollection
    {
        $posts = [];
        for ($x = 0; $x < self::$faker->numberBetween(10, 143); $x++) {
            $posts[] = self::createRandomPost();
        }

        return new PostCollection($posts);
    }

    private static function createRandomPost(): Post
    {
        $post = Post::create(UuidValueObject::generate(), self::$faker->words(3, asText: true), self::$faker->words(20, asText: true));

        for ($x = 0; $x < self::$faker->numberBetween(3, 13); $x++) {
            $comment = (Comment::create($post, UuidValueObject::generate(), self::$faker->words(5, asText: true)));
            $post->addComment($comment->getBody(), UuidValueObject::generate());
        }

        return $post;
    }

    public function getById(UuidValueObject $id): Post
    {
        return self::createRandomPost();
    }

}
