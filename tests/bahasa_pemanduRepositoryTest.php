<?php

use App\Models\bahasa_pemandu;
use App\Repositories\bahasa_pemanduRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class bahasa_pemanduRepositoryTest extends TestCase
{
    use Makebahasa_pemanduTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var bahasa_pemanduRepository
     */
    protected $bahasaPemanduRepo;

    public function setUp()
    {
        parent::setUp();
        $this->bahasaPemanduRepo = App::make(bahasa_pemanduRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatebahasa_pemandu()
    {
        $bahasaPemandu = $this->fakebahasa_pemanduData();
        $createdbahasa_pemandu = $this->bahasaPemanduRepo->create($bahasaPemandu);
        $createdbahasa_pemandu = $createdbahasa_pemandu->toArray();
        $this->assertArrayHasKey('id', $createdbahasa_pemandu);
        $this->assertNotNull($createdbahasa_pemandu['id'], 'Created bahasa_pemandu must have id specified');
        $this->assertNotNull(bahasa_pemandu::find($createdbahasa_pemandu['id']), 'bahasa_pemandu with given id must be in DB');
        $this->assertModelData($bahasaPemandu, $createdbahasa_pemandu);
    }

    /**
     * @test read
     */
    public function testReadbahasa_pemandu()
    {
        $bahasaPemandu = $this->makebahasa_pemandu();
        $dbbahasa_pemandu = $this->bahasaPemanduRepo->find($bahasaPemandu->id);
        $dbbahasa_pemandu = $dbbahasa_pemandu->toArray();
        $this->assertModelData($bahasaPemandu->toArray(), $dbbahasa_pemandu);
    }

    /**
     * @test update
     */
    public function testUpdatebahasa_pemandu()
    {
        $bahasaPemandu = $this->makebahasa_pemandu();
        $fakebahasa_pemandu = $this->fakebahasa_pemanduData();
        $updatedbahasa_pemandu = $this->bahasaPemanduRepo->update($fakebahasa_pemandu, $bahasaPemandu->id);
        $this->assertModelData($fakebahasa_pemandu, $updatedbahasa_pemandu->toArray());
        $dbbahasa_pemandu = $this->bahasaPemanduRepo->find($bahasaPemandu->id);
        $this->assertModelData($fakebahasa_pemandu, $dbbahasa_pemandu->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletebahasa_pemandu()
    {
        $bahasaPemandu = $this->makebahasa_pemandu();
        $resp = $this->bahasaPemanduRepo->delete($bahasaPemandu->id);
        $this->assertTrue($resp);
        $this->assertNull(bahasa_pemandu::find($bahasaPemandu->id), 'bahasa_pemandu should not exist in DB');
    }
}
