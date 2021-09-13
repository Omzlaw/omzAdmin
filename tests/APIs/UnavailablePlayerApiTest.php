<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UnavailablePlayer;

class UnavailablePlayerApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_unavailable_player()
    {
        $unavailablePlayer = UnavailablePlayer::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/unavailable_players', $unavailablePlayer
        );

        $this->assertApiResponse($unavailablePlayer);
    }

    /**
     * @test
     */
    public function test_read_unavailable_player()
    {
        $unavailablePlayer = UnavailablePlayer::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/unavailable_players/'.$unavailablePlayer->id
        );

        $this->assertApiResponse($unavailablePlayer->toArray());
    }

    /**
     * @test
     */
    public function test_update_unavailable_player()
    {
        $unavailablePlayer = UnavailablePlayer::factory()->create();
        $editedUnavailablePlayer = UnavailablePlayer::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/unavailable_players/'.$unavailablePlayer->id,
            $editedUnavailablePlayer
        );

        $this->assertApiResponse($editedUnavailablePlayer);
    }

    /**
     * @test
     */
    public function test_delete_unavailable_player()
    {
        $unavailablePlayer = UnavailablePlayer::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/unavailable_players/'.$unavailablePlayer->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/unavailable_players/'.$unavailablePlayer->id
        );

        $this->response->assertStatus(404);
    }
}
