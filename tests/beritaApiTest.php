<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class beritaApiTest extends TestCase
{
    use MakeberitaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateberita()
    {
        $berita = $this->fakeberitaData();
        $this->json('POST', '/api/v1/beritas', $berita);

        $this->assertApiResponse($berita);
    }

    /**
     * @test
     */
    public function testReadberita()
    {
        $berita = $this->makeberita();
        $this->json('GET', '/api/v1/beritas/'.$berita->id);

        $this->assertApiResponse($berita->toArray());
    }

    /**
     * @test
     */
    public function testUpdateberita()
    {
        $berita = $this->makeberita();
        $editedberita = $this->fakeberitaData();

        $this->json('PUT', '/api/v1/beritas/'.$berita->id, $editedberita);

        $this->assertApiResponse($editedberita);
    }

    /**
     * @test
     */
    public function testDeleteberita()
    {
        $berita = $this->makeberita();
        $this->json('DELETE', '/api/v1/beritas/'.$berita->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/beritas/'.$berita->id);

        $this->assertResponseStatus(404);
    }
}
