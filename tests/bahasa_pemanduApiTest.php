<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class bahasa_pemanduApiTest extends TestCase
{
    use Makebahasa_pemanduTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatebahasa_pemandu()
    {
        $bahasaPemandu = $this->fakebahasa_pemanduData();
        $this->json('POST', '/api/v1/bahasaPemandus', $bahasaPemandu);

        $this->assertApiResponse($bahasaPemandu);
    }

    /**
     * @test
     */
    public function testReadbahasa_pemandu()
    {
        $bahasaPemandu = $this->makebahasa_pemandu();
        $this->json('GET', '/api/v1/bahasaPemandus/'.$bahasaPemandu->id);

        $this->assertApiResponse($bahasaPemandu->toArray());
    }

    /**
     * @test
     */
    public function testUpdatebahasa_pemandu()
    {
        $bahasaPemandu = $this->makebahasa_pemandu();
        $editedbahasa_pemandu = $this->fakebahasa_pemanduData();

        $this->json('PUT', '/api/v1/bahasaPemandus/'.$bahasaPemandu->id, $editedbahasa_pemandu);

        $this->assertApiResponse($editedbahasa_pemandu);
    }

    /**
     * @test
     */
    public function testDeletebahasa_pemandu()
    {
        $bahasaPemandu = $this->makebahasa_pemandu();
        $this->json('DELETE', '/api/v1/bahasaPemandus/'.$bahasaPemandu->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/bahasaPemandus/'.$bahasaPemandu->id);

        $this->assertResponseStatus(404);
    }
}
