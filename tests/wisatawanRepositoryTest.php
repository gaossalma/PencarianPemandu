<?php

use App\Models\wisatawan;
use App\Repositories\wisatawanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class wisatawanRepositoryTest extends TestCase
{
    use MakewisatawanTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var wisatawanRepository
     */
    protected $wisatawanRepo;

    public function setUp()
    {
        parent::setUp();
        $this->wisatawanRepo = App::make(wisatawanRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatewisatawan()
    {
        $wisatawan = $this->fakewisatawanData();
        $createdwisatawan = $this->wisatawanRepo->create($wisatawan);
        $createdwisatawan = $createdwisatawan->toArray();
        $this->assertArrayHasKey('id', $createdwisatawan);
        $this->assertNotNull($createdwisatawan['id'], 'Created wisatawan must have id specified');
        $this->assertNotNull(wisatawan::find($createdwisatawan['id']), 'wisatawan with given id must be in DB');
        $this->assertModelData($wisatawan, $createdwisatawan);
    }

    /**
     * @test read
     */
    public function testReadwisatawan()
    {
        $wisatawan = $this->makewisatawan();
        $dbwisatawan = $this->wisatawanRepo->find($wisatawan->id);
        $dbwisatawan = $dbwisatawan->toArray();
        $this->assertModelData($wisatawan->toArray(), $dbwisatawan);
    }

    /**
     * @test update
     */
    public function testUpdatewisatawan()
    {
        $wisatawan = $this->makewisatawan();
        $fakewisatawan = $this->fakewisatawanData();
        $updatedwisatawan = $this->wisatawanRepo->update($fakewisatawan, $wisatawan->id);
        $this->assertModelData($fakewisatawan, $updatedwisatawan->toArray());
        $dbwisatawan = $this->wisatawanRepo->find($wisatawan->id);
        $this->assertModelData($fakewisatawan, $dbwisatawan->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletewisatawan()
    {
        $wisatawan = $this->makewisatawan();
        $resp = $this->wisatawanRepo->delete($wisatawan->id);
        $this->assertTrue($resp);
        $this->assertNull(wisatawan::find($wisatawan->id), 'wisatawan should not exist in DB');
    }
}
