<?php declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class BaseFakerFixture extends Fixture
{
    private const LOCALE = 'es_ES';

    /**
     * @var Generator
     */
    public static Generator $faker;

    public function __construct()
    {
        self::$faker = Factory::create(self::LOCALE);
    }

    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
    }
}