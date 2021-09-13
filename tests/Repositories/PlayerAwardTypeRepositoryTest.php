<?php namespace Tests\Repositories;

use App\Models\PlayerAwardType;
use App\Repositories\PlayerAwardTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PlayerAwardTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlayerAwardTypeRepository
     */
    protected $playerAwardTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->playerAwardTypeRepo = \App::make(PlayerAwardTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_player_award_type()
    {
        $playerAwardType = PlayerAwardType::factory()->make()->toArray();

        $createdPlayerAwardType = $this->playerAwardTypeRepo->create($playerAwardType);

        $createdPlayerAwardType = $createdPlayerAwardType->toArray();
        $this->assertArrayHasKey('id', $createdPlayerAwardType);
        $this->assertNotNull($createdPlayerAwardType['id'], 'Created PlayerAwardType must have id specified');
        $this->assertNotNull(PlayerAwardType::find($createdPlayerAwardType['id']), 'PlayerAwardType with given id must be in DB');
        $this->assertModelData($playerAwardType, $createdPlayerAwardType);
    }

    /**
     * @test read
     */
    public function test_read_player_award_type()
    {
        $playerAwardType = PlayerAwardType::factory()->create();

        $dbPlayerAwardType = $this->playerAwardTypeRepo->find($playerAwardType->id);

        $dbPlayerAwardType = $dbPlayerAwardType->toArray();
        $this->assertModelData($playerAwardType->toArray(), $dbPlayerAwardType);
    }

    /**
     * @test update
     */
    public function test_update_player_award_type()
    {
        $playerAwardType = PlayerAwardType::factory()->create();
        $fakePlayerAwardType = PlayerAwardType::factory()->make()->toArray();

        $updatedPlayerAwardType = $this->playerAwardTypeRepo->update($fakePlayerAwardType, $playerAwardType->id);

        $this->assertModelData($fakePlayerAwardType, $updatedPlayerAwardType->toArray());
        $dbPlayerAwardType = $this->playerAwardTypeRepo->find($playerAwardType->id);
        $this->assertModelData($fakePlayerAwardType, $dbPlayerAwardType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_player_award_type()
    {
        $playerAwardType = PlayerAwardType::factory()->create();

        $resp = $this->playerAwardTypeRepo->delete($playerAwardType->id);

        $this->assertTrue($resp);
        $this->assertNull(PlayerAwardType::find($playerAwardType->id), 'PlayerAwardType should not exist in DB');
    }
}
