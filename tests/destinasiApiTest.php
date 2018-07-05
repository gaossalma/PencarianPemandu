<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class destinasiApiTest extends TestCase
{
    use MakedestinasiTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatedestinasi()
    {
        $destinasi = $this->fakedestinasiData();
        $this->json('POST', '/api/v1/destinasis', $destinasi);

        $this->assertApiResponse($destinasi);
    }

    /**
     * @test
     */
    public function testReaddestinasi()
    {
        $destinasi = $this->makedestinasi();
        $this->json('GET', '/api/v1/destinasis/'.$destinasi->id);

        $this->assertApiResponse($destinasi->toArray());
    }

    /**
     * @test
     */
    public function testUpdatedestinasi()
    {
        $destinasi = $this->makedestinasi();
        $editeddestinasi = $this->fakedestinasiData();

        $this->json('PUT', '/api/v1/destinasis/'.$destinasi->id, $editeddestinasi);

        $this->assertApiResponse($editeddestinasi);
    }

    /**
     * @test
     */
    public function testDeletedestinasi()
    {
        $destinasi = $this->makedestinasi();
        $this->json('DELETE', '/api/v1/destinasis/'.$destinasi->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/destinasis/'.$destinasi->id);

        $this->assertResponseStatus(404);
    }
}
