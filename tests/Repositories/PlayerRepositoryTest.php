<?php namespace Tests\Repositories;

use App\Models\Player;
use App\Repositories\PlayerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PlayerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlayerRepository
     */
    protected $playerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->playerRepo = \App::make(PlayerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_player()
    {
        $player = Player::factory()->make()->toArray();

        $createdPlayer = $this->playerRepo->create($player);

        $createdPlayer = $createdPlayer->toArray();
        $this->assertArrayHasKey('id', $createdPlayer);
        $this->assertNotNull($createdPlayer['id'], 'Created Player must have id specified');
        $this->assertNotNull(Player::find($createdPlayer['id']), 'Player with given id must be in DB');
        $this->assertModelData($player, $createdPlayer);
    }

    /**
     * @test read
     */
    public function test_read_player()
    {
        $player = Player::factory()->create();

        $dbPlayer = $this->playerRepo->find($player->id);

        $dbPlayer = $dbPlayer->toArray();
        $this->assertModelData($player->toArray(), $dbPlayer);
    }

    /**
     * @test update
     */
    public function test_update_player()
    {
        $player = Player::factory()->create();
        $fakePlayer = Player::factory()->make()->toArray();

        $updatedPlayer = $this->playerRepo->update($fakePlayer, $player->id);

        $this->assertModelData($fakePlayer, $updatedPlayer->toArray());
        $dbPlayer = $this->playerRepo->find($player->id);
        $this->assertModelData($fakePlayer, $dbPlayer->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_player()
    {
        $player = Player::factory()->create();

        $resp = $this->playerRepo->delete($player->id);

        $this->assertTrue($resp);
        $this->assertNull(Player::find($player->id), 'Player should not exist in DB');
    }
}
