<?php declare(strict_types=1);

namespace App\Tests\Posts\Domain\Models;

use App\Modules\Posts\Domain\Post;
use PHPUnit\Framework\TestCase;
use Shared\Domain\ValueObject\UuidValueObject;

class PostTest extends TestCase
{

    /**
     * @test
     */
    public function I_can_create_a_post(): void
    {
        $post = Post::create(UuidValueObject::generate(), 'title', 'content');
        $this->assertInstanceOf(Post::class, $post);
    }

    /**
     * @test
     */
    public function a_pristine_new_post_has_no_comments(): void
    {
        $post = Post::create(UuidValueObject::generate(), 'title', 'content');
        $this->assertCount(0, $post->getComments());
        $this->assertEquals(0,$post->getTotalComments());
    }


    /**
     * @test
     */
    public function I_can_add_a_comment_to_a_post(): void
    {
        $post = Post::create(UuidValueObject::generate(), 'title', 'content');
        $post->addComment('comment body', UuidValueObject::generate());
        $this->assertCount(1, $post->getComments());
    }



    /**
     * @test
     */
    public function I_can_remove_a_comment_from_a_post(): void
    {
        $post = Post::create(UuidValueObject::generate(), 'title', 'content');
        $comment = $post->addComment('comment body', UuidValueObject::generate());
        $this->assertCount(1, $post->getComments());
        $post->removeComment($comment);
        $this->assertCount(0, $post->getComments(),'comments count is not 0');
        $this->assertEquals(0,$post->getTotalComments(),'totalComments count is not 0');
    }

}
