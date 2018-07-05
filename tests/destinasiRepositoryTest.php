<?php

use App\Models\destinasi;
use App\Repositories\destinasiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class destinasiRepositoryTest extends TestCase
{
    use MakedestinasiTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var destinasiRepository
     */
    protected $destinasiRepo;

    public function setUp()
    {
        parent::setUp();
        $this->destinasiRepo = App::make(destinasiRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatedestinasi()
    {
        $destinasi = $this->fakedestinasiData();
        $createddestinasi = $this->destinasiRepo->create($destinasi);
        $createddestinasi = $createddestinasi->toArray();
        $this->assertArrayHasKey('id', $createddestinasi);
        $this->assertNotNull($createddestinasi['id'], 'Created destinasi must have id specified');
        $this->assertNotNull(destinasi::find($createddestinasi['id']), 'destinasi with given id must be in DB');
        $this->assertModelData($destinasi, $createddestinasi);
    }

    /**
     * @test read
     */
    public function testReaddestinasi()
    {
        $destinasi = $this->makedestinasi();
        $dbdestinasi = $this->destinasiRepo->find($destinasi->id);
        $dbdestinasi = $dbdestinasi->toArray();
        $this->assertModelData($destinasi->toArray(), $dbdestinasi);
    }

    /**
     * @test update
     */
    public function testUpdatedestinasi()
    {
        $destinasi = $this->makedestinasi();
        $fakedestinasi = $this->fakedestinasiData();
        $updateddestinasi = $this->destinasiRepo->update($fakedestinasi, $destinasi->id);
        $this->assertModelData($fakedestinasi, $updateddestinasi->toArray());
        $dbdestinasi = $this->destinasiRepo->find($destinasi->id);
        $this->assertModelData($fakedestinasi, $dbdestinasi->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletedestinasi()
    {
        $destinasi = $this->makedestinasi();
        $resp = $this->destinasiRepo->delete($destinasi->id);
        $this->assertTrue($resp);
        $this->assertNull(destinasi::find($destinasi->id), 'destinasi should not exist in DB');
    }
}
