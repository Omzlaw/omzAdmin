<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MatchUnavailablePlayer;

class MatchUnavailablePlayerApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_match_unavailable_player()
    {
        $matchUnavailablePlayer = MatchUnavailablePlayer::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/match_unavailable_players', $matchUnavailablePlayer
        );

        $this->assertApiResponse($matchUnavailablePlayer);
    }

    /**
     * @test
     */
    public function test_read_match_unavailable_player()
    {
        $matchUnavailablePlayer = MatchUnavailablePlayer::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/match_unavailable_players/'.$matchUnavailablePlayer->id
        );

        $this->assertApiResponse($matchUnavailablePlayer->toArray());
    }

    /**
     * @test
     */
    public function test_update_match_unavailable_player()
    {
        $matchUnavailablePlayer = MatchUnavailablePlayer::factory()->create();
        $editedMatchUnavailablePlayer = MatchUnavailablePlayer::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/match_unavailable_players/'.$matchUnavailablePlayer->id,
            $editedMatchUnavailablePlayer
        );

        $this->assertApiResponse($editedMatchUnavailablePlayer);
    }

    /**
     * @test
     */
    public function test_delete_match_unavailable_player()
    {
        $matchUnavailablePlayer = MatchUnavailablePlayer::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/match_unavailable_players/'.$matchUnavailablePlayer->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/match_unavailable_players/'.$matchUnavailablePlayer->id
        );

        $this->response->assertStatus(404);
    }
}
