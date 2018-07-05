<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class wisatawanApiTest extends TestCase
{
    use MakewisatawanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatewisatawan()
    {
        $wisatawan = $this->fakewisatawanData();
        $this->json('POST', '/api/v1/wisatawans', $wisatawan);

        $this->assertApiResponse($wisatawan);
    }

    /**
     * @test
     */
    public function testReadwisatawan()
    {
        $wisatawan = $this->makewisatawan();
        $this->json('GET', '/api/v1/wisatawans/'.$wisatawan->id);

        $this->assertApiResponse($wisatawan->toArray());
    }

    /**
     * @test
     */
    public function testUpdatewisatawan()
    {
        $wisatawan = $this->makewisatawan();
        $editedwisatawan = $this->fakewisatawanData();

        $this->json('PUT', '/api/v1/wisatawans/'.$wisatawan->id, $editedwisatawan);

        $this->assertApiResponse($editedwisatawan);
    }

    /**
     * @test
     */
    public function testDeletewisatawan()
    {
        $wisatawan = $this->makewisatawan();
        $this->json('DELETE', '/api/v1/wisatawans/'.$wisatawan->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/wisatawans/'.$wisatawan->id);

        $this->assertResponseStatus(404);
    }
}
