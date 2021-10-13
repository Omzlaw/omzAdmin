<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\GamesPlayed;

class GamesPlayedApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_games_played()
    {
        $gamesPlayed = GamesPlayed::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/games_played', $gamesPlayed
        );

        $this->assertApiResponse($gamesPlayed);
    }

    /**
     * @test
     */
    public function test_read_games_played()
    {
        $gamesPlayed = GamesPlayed::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/games_played/'.$gamesPlayed->id
        );

        $this->assertApiResponse($gamesPlayed->toArray());
    }

    /**
     * @test
     */
    public function test_update_games_played()
    {
        $gamesPlayed = GamesPlayed::factory()->create();
        $editedGamesPlayed = GamesPlayed::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/games_played/'.$gamesPlayed->id,
            $editedGamesPlayed
        );

        $this->assertApiResponse($editedGamesPlayed);
    }

    /**
     * @test
     */
    public function test_delete_games_played()
    {
        $gamesPlayed = GamesPlayed::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/games_played/'.$gamesPlayed->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/games_played/'.$gamesPlayed->id
        );

        $this->response->assertStatus(404);
    }
}
