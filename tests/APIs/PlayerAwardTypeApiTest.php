<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PlayerAwardType;

class PlayerAwardTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_player_award_type()
    {
        $playerAwardType = PlayerAwardType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/player_award_types', $playerAwardType
        );

        $this->assertApiResponse($playerAwardType);
    }

    /**
     * @test
     */
    public function test_read_player_award_type()
    {
        $playerAwardType = PlayerAwardType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/player_award_types/'.$playerAwardType->id
        );

        $this->assertApiResponse($playerAwardType->toArray());
    }

    /**
     * @test
     */
    public function test_update_player_award_type()
    {
        $playerAwardType = PlayerAwardType::factory()->create();
        $editedPlayerAwardType = PlayerAwardType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/player_award_types/'.$playerAwardType->id,
            $editedPlayerAwardType
        );

        $this->assertApiResponse($editedPlayerAwardType);
    }

    /**
     * @test
     */
    public function test_delete_player_award_type()
    {
        $playerAwardType = PlayerAwardType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/player_award_types/'.$playerAwardType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/player_award_types/'.$playerAwardType->id
        );

        $this->response->assertStatus(404);
    }
}
