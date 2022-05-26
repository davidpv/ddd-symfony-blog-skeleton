<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Modules\Posts\Domain\Post;
use App\Modules\Users\Domain\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends BaseFakerFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        for ($x = 0; $x < self::$faker->numberBetween(23,135); $x++) {
            /** @var \App\Modules\Users\Domain\User $user */
            $user = $this->getReference(sprintf('user.%d', self::$faker->numberBetween(0, 99)));
            $post = Post::create($user->getId(), self::$faker->words(3, asText: true), self::$faker->words(20, asText: true));
            $this->addReference(sprintf('post.%d', $x), $post);

            for ($i = 0; $i < self::$faker->numberBetween(0,35); $i++) {
                $user = $this->getReference(sprintf('user.%d', self::$faker->numberBetween(0, 99)));
                $comment = $post->addComment(self::$faker->words(5, asText: true), $user->getId());

                $manager->persist($comment);
            }

            $manager->persist($post);
        }
        $manager->flush();

    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
