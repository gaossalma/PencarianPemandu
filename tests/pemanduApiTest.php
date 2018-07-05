<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class pemanduApiTest extends TestCase
{
    use MakepemanduTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatepemandu()
    {
        $pemandu = $this->fakepemanduData();
        $this->json('POST', '/api/v1/pemandus', $pemandu);

        $this->assertApiResponse($pemandu);
    }

    /**
     * @test
     */
    public function testReadpemandu()
    {
        $pemandu = $this->makepemandu();
        $this->json('GET', '/api/v1/pemandus/'.$pemandu->id);

        $this->assertApiResponse($pemandu->toArray());
    }

    /**
     * @test
     */
    public function testUpdatepemandu()
    {
        $pemandu = $this->makepemandu();
        $editedpemandu = $this->fakepemanduData();

        $this->json('PUT', '/api/v1/pemandus/'.$pemandu->id, $editedpemandu);

        $this->assertApiResponse($editedpemandu);
    }

    /**
     * @test
     */
    public function testDeletepemandu()
    {
        $pemandu = $this->makepemandu();
        $this->json('DELETE', '/api/v1/pemandus/'.$pemandu->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/pemandus/'.$pemandu->id);

        $this->assertResponseStatus(404);
    }
}
