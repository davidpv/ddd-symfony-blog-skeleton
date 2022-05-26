<?php declare(strict_types=1);

namespace Shared\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AbstractApiTestCase extends ApiTestCase
{

    private static Client $client;
    private static ?ContainerInterface $container;

    public function setUp(): void
    {
        static::$client = static::createClient();
        static::$container = static::$client->getContainer();

        $entityManager = static::$container->get('doctrine')->getManager();
        $metadata = $entityManager->getMetadataFactory()->getAllMetadata();

        $schemaTool = new SchemaTool($entityManager);
        $schemaTool->dropSchema($metadata);
        $schemaTool->updateSchema($metadata);

        parent::setUp();
    }

}