<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PlayerPosition;

class PlayerPositionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_player_position()
    {
        $playerPosition = PlayerPosition::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/player_positions', $playerPosition
        );

        $this->assertApiResponse($playerPosition);
    }

    /**
     * @test
     */
    public function test_read_player_position()
    {
        $playerPosition = PlayerPosition::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/player_positions/'.$playerPosition->id
        );

        $this->assertApiResponse($playerPosition->toArray());
    }

    /**
     * @test
     */
    public function test_update_player_position()
    {
        $playerPosition = PlayerPosition::factory()->create();
        $editedPlayerPosition = PlayerPosition::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/player_positions/'.$playerPosition->id,
            $editedPlayerPosition
        );

        $this->assertApiResponse($editedPlayerPosition);
    }

    /**
     * @test
     */
    public function test_delete_player_position()
    {
        $playerPosition = PlayerPosition::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/player_positions/'.$playerPosition->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/player_positions/'.$playerPosition->id
        );

        $this->response->assertStatus(404);
    }
}
