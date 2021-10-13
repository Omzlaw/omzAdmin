<?php namespace Tests\Repositories;

use App\Models\GamesPlayed;
use App\Repositories\GamesPlayedRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class GamesPlayedRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var GamesPlayedRepository
     */
    protected $gamesPlayedRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->gamesPlayedRepo = \App::make(GamesPlayedRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_games_played()
    {
        $gamesPlayed = GamesPlayed::factory()->make()->toArray();

        $createdGamesPlayed = $this->gamesPlayedRepo->create($gamesPlayed);

        $createdGamesPlayed = $createdGamesPlayed->toArray();
        $this->assertArrayHasKey('id', $createdGamesPlayed);
        $this->assertNotNull($createdGamesPlayed['id'], 'Created GamesPlayed must have id specified');
        $this->assertNotNull(GamesPlayed::find($createdGamesPlayed['id']), 'GamesPlayed with given id must be in DB');
        $this->assertModelData($gamesPlayed, $createdGamesPlayed);
    }

    /**
     * @test read
     */
    public function test_read_games_played()
    {
        $gamesPlayed = GamesPlayed::factory()->create();

        $dbGamesPlayed = $this->gamesPlayedRepo->find($gamesPlayed->id);

        $dbGamesPlayed = $dbGamesPlayed->toArray();
        $this->assertModelData($gamesPlayed->toArray(), $dbGamesPlayed);
    }

    /**
     * @test update
     */
    public function test_update_games_played()
    {
        $gamesPlayed = GamesPlayed::factory()->create();
        $fakeGamesPlayed = GamesPlayed::factory()->make()->toArray();

        $updatedGamesPlayed = $this->gamesPlayedRepo->update($fakeGamesPlayed, $gamesPlayed->id);

        $this->assertModelData($fakeGamesPlayed, $updatedGamesPlayed->toArray());
        $dbGamesPlayed = $this->gamesPlayedRepo->find($gamesPlayed->id);
        $this->assertModelData($fakeGamesPlayed, $dbGamesPlayed->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_games_played()
    {
        $gamesPlayed = GamesPlayed::factory()->create();

        $resp = $this->gamesPlayedRepo->delete($gamesPlayed->id);

        $this->assertTrue($resp);
        $this->assertNull(GamesPlayed::find($gamesPlayed->id), 'GamesPlayed should not exist in DB');
    }
}
