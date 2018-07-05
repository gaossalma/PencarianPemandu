<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class bahasaApiTest extends TestCase
{
    use MakebahasaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatebahasa()
    {
        $bahasa = $this->fakebahasaData();
        $this->json('POST', '/api/v1/bahasas', $bahasa);

        $this->assertApiResponse($bahasa);
    }

    /**
     * @test
     */
    public function testReadbahasa()
    {
        $bahasa = $this->makebahasa();
        $this->json('GET', '/api/v1/bahasas/'.$bahasa->id);

        $this->assertApiResponse($bahasa->toArray());
    }

    /**
     * @test
     */
    public function testUpdatebahasa()
    {
        $bahasa = $this->makebahasa();
        $editedbahasa = $this->fakebahasaData();

        $this->json('PUT', '/api/v1/bahasas/'.$bahasa->id, $editedbahasa);

        $this->assertApiResponse($editedbahasa);
    }

    /**
     * @test
     */
    public function testDeletebahasa()
    {
        $bahasa = $this->makebahasa();
        $this->json('DELETE', '/api/v1/bahasas/'.$bahasa->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/bahasas/'.$bahasa->id);

        $this->assertResponseStatus(404);
    }
}
