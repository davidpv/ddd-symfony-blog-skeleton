<?php declare(strict_types=1);

namespace App\Tests\Users\Controllers\Api;

use App\Modules\Users\Domain\User;
use Shared\Tests\Api\DoctrineApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class ListUsersControllerApiTest extends DoctrineApiTestCase
{


    /**
     * @test
     */
    public function list_users_retuns_collection_greather_than_0()
    {
        $user = User::create('admin', 'admin@admin.com', 'admin', 'admin');

        self::$entityManager->persist($user);
        $this->flush();

        $response = static::createClient()->request('GET', '/api/v1/users');

        self::assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertJson($response->getContent());
        $this->assertJsonContains(['total' => 1]);
    }


}
