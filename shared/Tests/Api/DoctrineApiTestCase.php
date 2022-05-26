<?php declare(strict_types=1);

namespace Shared\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class DoctrineApiTestCase extends ApiTestCase
{

    private static Client $client;
    private static ?ContainerInterface $container;
    public static EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        static::$client = static::createClient();
        static::$container = static::$client->getContainer();
        self::$entityManager = static::$container
            ->get('doctrine')
            ->getManager();
        $metadata = self::$entityManager
            ->getMetadataFactory()
            ->getAllMetadata();

        $schemaTool = new SchemaTool(self::$entityManager);

        $schemaTool->dropSchema($metadata);
        $schemaTool->updateSchema($metadata);

        parent::setUp();
    }

    protected function flush(): void
    {
        self::$entityManager->flush();
        self::$entityManager->clear();
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        self::$entityManager->getConnection()->close();
    }

}