<?php

use App\Models\berita;
use App\Repositories\beritaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class beritaRepositoryTest extends TestCase
{
    use MakeberitaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var beritaRepository
     */
    protected $beritaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->beritaRepo = App::make(beritaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateberita()
    {
        $berita = $this->fakeberitaData();
        $createdberita = $this->beritaRepo->create($berita);
        $createdberita = $createdberita->toArray();
        $this->assertArrayHasKey('id', $createdberita);
        $this->assertNotNull($createdberita['id'], 'Created berita must have id specified');
        $this->assertNotNull(berita::find($createdberita['id']), 'berita with given id must be in DB');
        $this->assertModelData($berita, $createdberita);
    }

    /**
     * @test read
     */
    public function testReadberita()
    {
        $berita = $this->makeberita();
        $dbberita = $this->beritaRepo->find($berita->id);
        $dbberita = $dbberita->toArray();
        $this->assertModelData($berita->toArray(), $dbberita);
    }

    /**
     * @test update
     */
    public function testUpdateberita()
    {
        $berita = $this->makeberita();
        $fakeberita = $this->fakeberitaData();
        $updatedberita = $this->beritaRepo->update($fakeberita, $berita->id);
        $this->assertModelData($fakeberita, $updatedberita->toArray());
        $dbberita = $this->beritaRepo->find($berita->id);
        $this->assertModelData($fakeberita, $dbberita->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteberita()
    {
        $berita = $this->makeberita();
        $resp = $this->beritaRepo->delete($berita->id);
        $this->assertTrue($resp);
        $this->assertNull(berita::find($berita->id), 'berita should not exist in DB');
    }
}
