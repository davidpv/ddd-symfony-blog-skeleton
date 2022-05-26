<?php

namespace App\Modules\Posts\Application\GetPost;

use App\Modules\Posts\Domain\GetPostQuery;
use App\Modules\Posts\Domain\Post;
use App\Modules\Posts\Domain\PostRepository;
use Shared\Domain\Bus\Query\QueryHandler;
use Shared\Domain\ValueObject\UuidValueObject;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetPostQueryHandler implements QueryHandler
{

    public function __construct(private PostRepository $repository)
    {
    }

    public function __invoke(GetPostQuery $query): Post
    {
        $id = UuidValueObject::createFromString($query->getId());
        $post = $this->repository->getById($id);
        if (!$post) {
            throw new NotFoundHttpException('Post not found');
        }

        return $post;
    }

}
