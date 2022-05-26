<?php

namespace App\DataFixtures;

use App\Modules\Users\Domain\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends BaseFakerFixture
{
    public function load(ObjectManager $manager): void
    {
        $user = User::create('admin', 'admin@admin.com', 'David', 'Perez');
        $manager->persist($user);
        $this->addReference('user.admin', $user);
        for ($i = 0; $i < 100; $i++) {
            $user = User::create(self::$faker->userName, self::$faker->email, self::$faker->firstName, self::$faker->lastName);
            $this->addReference(sprintf('user.%d', $i), $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
