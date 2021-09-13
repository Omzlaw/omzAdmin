<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\JerseySetPlayer;

class JerseySetPlayerApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_jersey_set_player()
    {
        $jerseySetPlayer = JerseySetPlayer::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/jersey_set_players', $jerseySetPlayer
        );

        $this->assertApiResponse($jerseySetPlayer);
    }

    /**
     * @test
     */
    public function test_read_jersey_set_player()
    {
        $jerseySetPlayer = JerseySetPlayer::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/jersey_set_players/'.$jerseySetPlayer->id
        );

        $this->assertApiResponse($jerseySetPlayer->toArray());
    }

    /**
     * @test
     */
    public function test_update_jersey_set_player()
    {
        $jerseySetPlayer = JerseySetPlayer::factory()->create();
        $editedJerseySetPlayer = JerseySetPlayer::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/jersey_set_players/'.$jerseySetPlayer->id,
            $editedJerseySetPlayer
        );

        $this->assertApiResponse($editedJerseySetPlayer);
    }

    /**
     * @test
     */
    public function test_delete_jersey_set_player()
    {
        $jerseySetPlayer = JerseySetPlayer::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/jersey_set_players/'.$jerseySetPlayer->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/jersey_set_players/'.$jerseySetPlayer->id
        );

        $this->response->assertStatus(404);
    }
}
