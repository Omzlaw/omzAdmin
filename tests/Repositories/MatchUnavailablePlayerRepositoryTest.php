<?php namespace Tests\Repositories;

use App\Models\MatchUnavailablePlayer;
use App\Repositories\MatchUnavailablePlayerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MatchUnavailablePlayerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MatchUnavailablePlayerRepository
     */
    protected $matchUnavailablePlayerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->matchUnavailablePlayerRepo = \App::make(MatchUnavailablePlayerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_match_unavailable_player()
    {
        $matchUnavailablePlayer = MatchUnavailablePlayer::factory()->make()->toArray();

        $createdMatchUnavailablePlayer = $this->matchUnavailablePlayerRepo->create($matchUnavailablePlayer);

        $createdMatchUnavailablePlayer = $createdMatchUnavailablePlayer->toArray();
        $this->assertArrayHasKey('id', $createdMatchUnavailablePlayer);
        $this->assertNotNull($createdMatchUnavailablePlayer['id'], 'Created MatchUnavailablePlayer must have id specified');
        $this->assertNotNull(MatchUnavailablePlayer::find($createdMatchUnavailablePlayer['id']), 'MatchUnavailablePlayer with given id must be in DB');
        $this->assertModelData($matchUnavailablePlayer, $createdMatchUnavailablePlayer);
    }

    /**
     * @test read
     */
    public function test_read_match_unavailable_player()
    {
        $matchUnavailablePlayer = MatchUnavailablePlayer::factory()->create();

        $dbMatchUnavailablePlayer = $this->matchUnavailablePlayerRepo->find($matchUnavailablePlayer->id);

        $dbMatchUnavailablePlayer = $dbMatchUnavailablePlayer->toArray();
        $this->assertModelData($matchUnavailablePlayer->toArray(), $dbMatchUnavailablePlayer);
    }

    /**
     * @test update
     */
    public function test_update_match_unavailable_player()
    {
        $matchUnavailablePlayer = MatchUnavailablePlayer::factory()->create();
        $fakeMatchUnavailablePlayer = MatchUnavailablePlayer::factory()->make()->toArray();

        $updatedMatchUnavailablePlayer = $this->matchUnavailablePlayerRepo->update($fakeMatchUnavailablePlayer, $matchUnavailablePlayer->id);

        $this->assertModelData($fakeMatchUnavailablePlayer, $updatedMatchUnavailablePlayer->toArray());
        $dbMatchUnavailablePlayer = $this->matchUnavailablePlayerRepo->find($matchUnavailablePlayer->id);
        $this->assertModelData($fakeMatchUnavailablePlayer, $dbMatchUnavailablePlayer->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_match_unavailable_player()
    {
        $matchUnavailablePlayer = MatchUnavailablePlayer::factory()->create();

        $resp = $this->matchUnavailablePlayerRepo->delete($matchUnavailablePlayer->id);

        $this->assertTrue($resp);
        $this->assertNull(MatchUnavailablePlayer::find($matchUnavailablePlayer->id), 'MatchUnavailablePlayer should not exist in DB');
    }
}
