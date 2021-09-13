<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PlayerAward;

class PlayerAwardApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_player_award()
    {
        $playerAward = PlayerAward::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/player_awards', $playerAward
        );

        $this->assertApiResponse($playerAward);
    }

    /**
     * @test
     */
    public function test_read_player_award()
    {
        $playerAward = PlayerAward::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/player_awards/'.$playerAward->id
        );

        $this->assertApiResponse($playerAward->toArray());
    }

    /**
     * @test
     */
    public function test_update_player_award()
    {
        $playerAward = PlayerAward::factory()->create();
        $editedPlayerAward = PlayerAward::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/player_awards/'.$playerAward->id,
            $editedPlayerAward
        );

        $this->assertApiResponse($editedPlayerAward);
    }

    /**
     * @test
     */
    public function test_delete_player_award()
    {
        $playerAward = PlayerAward::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/player_awards/'.$playerAward->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/player_awards/'.$playerAward->id
        );

        $this->response->assertStatus(404);
    }
}
