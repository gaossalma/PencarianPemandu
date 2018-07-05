<?php

use App\Models\bahasa;
use App\Repositories\bahasaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class bahasaRepositoryTest extends TestCase
{
    use MakebahasaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var bahasaRepository
     */
    protected $bahasaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->bahasaRepo = App::make(bahasaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatebahasa()
    {
        $bahasa = $this->fakebahasaData();
        $createdbahasa = $this->bahasaRepo->create($bahasa);
        $createdbahasa = $createdbahasa->toArray();
        $this->assertArrayHasKey('id', $createdbahasa);
        $this->assertNotNull($createdbahasa['id'], 'Created bahasa must have id specified');
        $this->assertNotNull(bahasa::find($createdbahasa['id']), 'bahasa with given id must be in DB');
        $this->assertModelData($bahasa, $createdbahasa);
    }

    /**
     * @test read
     */
    public function testReadbahasa()
    {
        $bahasa = $this->makebahasa();
        $dbbahasa = $this->bahasaRepo->find($bahasa->id);
        $dbbahasa = $dbbahasa->toArray();
        $this->assertModelData($bahasa->toArray(), $dbbahasa);
    }

    /**
     * @test update
     */
    public function testUpdatebahasa()
    {
        $bahasa = $this->makebahasa();
        $fakebahasa = $this->fakebahasaData();
        $updatedbahasa = $this->bahasaRepo->update($fakebahasa, $bahasa->id);
        $this->assertModelData($fakebahasa, $updatedbahasa->toArray());
        $dbbahasa = $this->bahasaRepo->find($bahasa->id);
        $this->assertModelData($fakebahasa, $dbbahasa->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletebahasa()
    {
        $bahasa = $this->makebahasa();
        $resp = $this->bahasaRepo->delete($bahasa->id);
        $this->assertTrue($resp);
        $this->assertNull(bahasa::find($bahasa->id), 'bahasa should not exist in DB');
    }
}
