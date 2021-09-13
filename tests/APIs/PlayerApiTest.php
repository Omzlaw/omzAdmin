<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Player;

class PlayerApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_player()
    {
        $player = Player::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/players', $player
        );

        $this->assertApiResponse($player);
    }

    /**
     * @test
     */
    public function test_read_player()
    {
        $player = Player::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/players/'.$player->id
        );

        $this->assertApiResponse($player->toArray());
    }

    /**
     * @test
     */
    public function test_update_player()
    {
        $player = Player::factory()->create();
        $editedPlayer = Player::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/players/'.$player->id,
            $editedPlayer
        );

        $this->assertApiResponse($editedPlayer);
    }

    /**
     * @test
     */
    public function test_delete_player()
    {
        $player = Player::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/players/'.$player->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/players/'.$player->id
        );

        $this->response->assertStatus(404);
    }
}
