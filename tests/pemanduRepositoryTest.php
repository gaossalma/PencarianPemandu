<?php

use App\Models\pemandu;
use App\Repositories\pemanduRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class pemanduRepositoryTest extends TestCase
{
    use MakepemanduTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var pemanduRepository
     */
    protected $pemanduRepo;

    public function setUp()
    {
        parent::setUp();
        $this->pemanduRepo = App::make(pemanduRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatepemandu()
    {
        $pemandu = $this->fakepemanduData();
        $createdpemandu = $this->pemanduRepo->create($pemandu);
        $createdpemandu = $createdpemandu->toArray();
        $this->assertArrayHasKey('id', $createdpemandu);
        $this->assertNotNull($createdpemandu['id'], 'Created pemandu must have id specified');
        $this->assertNotNull(pemandu::find($createdpemandu['id']), 'pemandu with given id must be in DB');
        $this->assertModelData($pemandu, $createdpemandu);
    }

    /**
     * @test read
     */
    public function testReadpemandu()
    {
        $pemandu = $this->makepemandu();
        $dbpemandu = $this->pemanduRepo->find($pemandu->id);
        $dbpemandu = $dbpemandu->toArray();
        $this->assertModelData($pemandu->toArray(), $dbpemandu);
    }

    /**
     * @test update
     */
    public function testUpdatepemandu()
    {
        $pemandu = $this->makepemandu();
        $fakepemandu = $this->fakepemanduData();
        $updatedpemandu = $this->pemanduRepo->update($fakepemandu, $pemandu->id);
        $this->assertModelData($fakepemandu, $updatedpemandu->toArray());
        $dbpemandu = $this->pemanduRepo->find($pemandu->id);
        $this->assertModelData($fakepemandu, $dbpemandu->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletepemandu()
    {
        $pemandu = $this->makepemandu();
        $resp = $this->pemanduRepo->delete($pemandu->id);
        $this->assertTrue($resp);
        $this->assertNull(pemandu::find($pemandu->id), 'pemandu should not exist in DB');
    }
}
