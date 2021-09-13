<?php namespace Tests\Repositories;

use App\Models\PlayerPosition;
use App\Repositories\PlayerPositionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PlayerPositionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlayerPositionRepository
     */
    protected $playerPositionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->playerPositionRepo = \App::make(PlayerPositionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_player_position()
    {
        $playerPosition = PlayerPosition::factory()->make()->toArray();

        $createdPlayerPosition = $this->playerPositionRepo->create($playerPosition);

        $createdPlayerPosition = $createdPlayerPosition->toArray();
        $this->assertArrayHasKey('id', $createdPlayerPosition);
        $this->assertNotNull($createdPlayerPosition['id'], 'Created PlayerPosition must have id specified');
        $this->assertNotNull(PlayerPosition::find($createdPlayerPosition['id']), 'PlayerPosition with given id must be in DB');
        $this->assertModelData($playerPosition, $createdPlayerPosition);
    }

    /**
     * @test read
     */
    public function test_read_player_position()
    {
        $playerPosition = PlayerPosition::factory()->create();

        $dbPlayerPosition = $this->playerPositionRepo->find($playerPosition->id);

        $dbPlayerPosition = $dbPlayerPosition->toArray();
        $this->assertModelData($playerPosition->toArray(), $dbPlayerPosition);
    }

    /**
     * @test update
     */
    public function test_update_player_position()
    {
        $playerPosition = PlayerPosition::factory()->create();
        $fakePlayerPosition = PlayerPosition::factory()->make()->toArray();

        $updatedPlayerPosition = $this->playerPositionRepo->update($fakePlayerPosition, $playerPosition->id);

        $this->assertModelData($fakePlayerPosition, $updatedPlayerPosition->toArray());
        $dbPlayerPosition = $this->playerPositionRepo->find($playerPosition->id);
        $this->assertModelData($fakePlayerPosition, $dbPlayerPosition->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_player_position()
    {
        $playerPosition = PlayerPosition::factory()->create();

        $resp = $this->playerPositionRepo->delete($playerPosition->id);

        $this->assertTrue($resp);
        $this->assertNull(PlayerPosition::find($playerPosition->id), 'PlayerPosition should not exist in DB');
    }
}
