<?php declare(strict_types=1);

namespace Shared\Infrastructure\Persistence\Faker;

use Faker\Factory;
use Faker\Generator;

abstract class FakerRepository
{
    private const LOCALE = 'es_ES';

    public static Generator $faker;

    public function __construct()
    {
        self::$faker = Factory::create(self::LOCALE);
    }
}