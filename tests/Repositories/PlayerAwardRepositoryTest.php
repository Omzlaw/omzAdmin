<?php namespace Tests\Repositories;

use App\Models\PlayerAward;
use App\Repositories\PlayerAwardRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PlayerAwardRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlayerAwardRepository
     */
    protected $playerAwardRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->playerAwardRepo = \App::make(PlayerAwardRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_player_award()
    {
        $playerAward = PlayerAward::factory()->make()->toArray();

        $createdPlayerAward = $this->playerAwardRepo->create($playerAward);

        $createdPlayerAward = $createdPlayerAward->toArray();
        $this->assertArrayHasKey('id', $createdPlayerAward);
        $this->assertNotNull($createdPlayerAward['id'], 'Created PlayerAward must have id specified');
        $this->assertNotNull(PlayerAward::find($createdPlayerAward['id']), 'PlayerAward with given id must be in DB');
        $this->assertModelData($playerAward, $createdPlayerAward);
    }

    /**
     * @test read
     */
    public function test_read_player_award()
    {
        $playerAward = PlayerAward::factory()->create();

        $dbPlayerAward = $this->playerAwardRepo->find($playerAward->id);

        $dbPlayerAward = $dbPlayerAward->toArray();
        $this->assertModelData($playerAward->toArray(), $dbPlayerAward);
    }

    /**
     * @test update
     */
    public function test_update_player_award()
    {
        $playerAward = PlayerAward::factory()->create();
        $fakePlayerAward = PlayerAward::factory()->make()->toArray();

        $updatedPlayerAward = $this->playerAwardRepo->update($fakePlayerAward, $playerAward->id);

        $this->assertModelData($fakePlayerAward, $updatedPlayerAward->toArray());
        $dbPlayerAward = $this->playerAwardRepo->find($playerAward->id);
        $this->assertModelData($fakePlayerAward, $dbPlayerAward->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_player_award()
    {
        $playerAward = PlayerAward::factory()->create();

        $resp = $this->playerAwardRepo->delete($playerAward->id);

        $this->assertTrue($resp);
        $this->assertNull(PlayerAward::find($playerAward->id), 'PlayerAward should not exist in DB');
    }
}
