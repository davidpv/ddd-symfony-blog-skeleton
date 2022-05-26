<?php declare(strict_types=1);

namespace App\Modules\Posts\Domain;

use Shared\Domain\ValueObject\UuidValueObject;

interface PostRepository
{

    public function getBy(PostCriteria $criteria): PostCollection;

    public function getById(UuidValueObject $id): ?Post;

}
