<?php declare(strict_types=1);

namespace App\Tests\Posts\Controllers\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class ListPostControllerTest extends ApiTestCase
{


    /**
     * @test
     */
    public function list_posts_retuns_collection_greather_than_0()
    {

        $response = static::createClient()->request('GET', '/api/v1/posts');
        self::assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertJson($response->getContent());
        $data = json_decode($response->getContent(), true);


        $this->assertIsArray($data);
        $this->assertGreaterThan(0, count($data));

    }

}
