<?php declare(strict_types=1);

namespace App\Modules\Posts\Infrastructure\Repositories;

use App\Modules\Posts\Domain\Post;
use App\Modules\Posts\Domain\PostCollection;
use App\Modules\Posts\Domain\PostRepository;
use Shared\Domain\Criteria\Criteria;
use Shared\Domain\ValueObject\UuidValueObject;
use Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

class DoctrinePostRepository extends DoctrineRepository implements PostRepository
{

    public function getById(UuidValueObject $id): ?Post
    {
        return $this->entityManager()->find(Post::class, $id);
    }

    public function getBy(Criteria $criteria): PostCollection
    {
        $builder = $this->entityManager()->createQueryBuilder()
            ->select('post')
            ->from(Post::class, 'post');
        $results = $builder->getQuery()->getResult();
        return new PostCollection($results);
    }

    public function save(Post $post): void
    {
        // TODO: Implement save() method.
    }
}
