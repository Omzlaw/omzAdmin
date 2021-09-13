<?php namespace Tests\Repositories;

use App\Models\UnavailablePlayerType;
use App\Repositories\UnavailablePlayerTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UnavailablePlayerTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UnavailablePlayerTypeRepository
     */
    protected $unavailablePlayerTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->unavailablePlayerTypeRepo = \App::make(UnavailablePlayerTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_unavailable_player_type()
    {
        $unavailablePlayerType = UnavailablePlayerType::factory()->make()->toArray();

        $createdUnavailablePlayerType = $this->unavailablePlayerTypeRepo->create($unavailablePlayerType);

        $createdUnavailablePlayerType = $createdUnavailablePlayerType->toArray();
        $this->assertArrayHasKey('id', $createdUnavailablePlayerType);
        $this->assertNotNull($createdUnavailablePlayerType['id'], 'Created UnavailablePlayerType must have id specified');
        $this->assertNotNull(UnavailablePlayerType::find($createdUnavailablePlayerType['id']), 'UnavailablePlayerType with given id must be in DB');
        $this->assertModelData($unavailablePlayerType, $createdUnavailablePlayerType);
    }

    /**
     * @test read
     */
    public function test_read_unavailable_player_type()
    {
        $unavailablePlayerType = UnavailablePlayerType::factory()->create();

        $dbUnavailablePlayerType = $this->unavailablePlayerTypeRepo->find($unavailablePlayerType->id);

        $dbUnavailablePlayerType = $dbUnavailablePlayerType->toArray();
        $this->assertModelData($unavailablePlayerType->toArray(), $dbUnavailablePlayerType);
    }

    /**
     * @test update
     */
    public function test_update_unavailable_player_type()
    {
        $unavailablePlayerType = UnavailablePlayerType::factory()->create();
        $fakeUnavailablePlayerType = UnavailablePlayerType::factory()->make()->toArray();

        $updatedUnavailablePlayerType = $this->unavailablePlayerTypeRepo->update($fakeUnavailablePlayerType, $unavailablePlayerType->id);

        $this->assertModelData($fakeUnavailablePlayerType, $updatedUnavailablePlayerType->toArray());
        $dbUnavailablePlayerType = $this->unavailablePlayerTypeRepo->find($unavailablePlayerType->id);
        $this->assertModelData($fakeUnavailablePlayerType, $dbUnavailablePlayerType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_unavailable_player_type()
    {
        $unavailablePlayerType = UnavailablePlayerType::factory()->create();

        $resp = $this->unavailablePlayerTypeRepo->delete($unavailablePlayerType->id);

        $this->assertTrue($resp);
        $this->assertNull(UnavailablePlayerType::find($unavailablePlayerType->id), 'UnavailablePlayerType should not exist in DB');
    }
}
