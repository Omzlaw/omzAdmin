<?php namespace Tests\Repositories;

use App\Models\TrophyType;
use App\Repositories\TrophyTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TrophyTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TrophyTypeRepository
     */
    protected $trophyTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->trophyTypeRepo = \App::make(TrophyTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_trophy_type()
    {
        $trophyType = TrophyType::factory()->make()->toArray();

        $createdTrophyType = $this->trophyTypeRepo->create($trophyType);

        $createdTrophyType = $createdTrophyType->toArray();
        $this->assertArrayHasKey('id', $createdTrophyType);
        $this->assertNotNull($createdTrophyType['id'], 'Created TrophyType must have id specified');
        $this->assertNotNull(TrophyType::find($createdTrophyType['id']), 'TrophyType with given id must be in DB');
        $this->assertModelData($trophyType, $createdTrophyType);
    }

    /**
     * @test read
     */
    public function test_read_trophy_type()
    {
        $trophyType = TrophyType::factory()->create();

        $dbTrophyType = $this->trophyTypeRepo->find($trophyType->id);

        $dbTrophyType = $dbTrophyType->toArray();
        $this->assertModelData($trophyType->toArray(), $dbTrophyType);
    }

    /**
     * @test update
     */
    public function test_update_trophy_type()
    {
        $trophyType = TrophyType::factory()->create();
        $fakeTrophyType = TrophyType::factory()->make()->toArray();

        $updatedTrophyType = $this->trophyTypeRepo->update($fakeTrophyType, $trophyType->id);

        $this->assertModelData($fakeTrophyType, $updatedTrophyType->toArray());
        $dbTrophyType = $this->trophyTypeRepo->find($trophyType->id);
        $this->assertModelData($fakeTrophyType, $dbTrophyType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_trophy_type()
    {
        $trophyType = TrophyType::factory()->create();

        $resp = $this->trophyTypeRepo->delete($trophyType->id);

        $this->assertTrue($resp);
        $this->assertNull(TrophyType::find($trophyType->id), 'TrophyType should not exist in DB');
    }
}
