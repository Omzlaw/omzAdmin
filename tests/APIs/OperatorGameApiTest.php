<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OperatorGame;

class OperatorGameApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_operator_game()
    {
        $operatorGame = OperatorGame::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/operator_games', $operatorGame
        );

        $this->assertApiResponse($operatorGame);
    }

    /**
     * @test
     */
    public function test_read_operator_game()
    {
        $operatorGame = OperatorGame::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/operator_games/'.$operatorGame->id
        );

        $this->assertApiResponse($operatorGame->toArray());
    }

    /**
     * @test
     */
    public function test_update_operator_game()
    {
        $operatorGame = OperatorGame::factory()->create();
        $editedOperatorGame = OperatorGame::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/operator_games/'.$operatorGame->id,
            $editedOperatorGame
        );

        $this->assertApiResponse($editedOperatorGame);
    }

    /**
     * @test
     */
    public function test_delete_operator_game()
    {
        $operatorGame = OperatorGame::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/operator_games/'.$operatorGame->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/operator_games/'.$operatorGame->id
        );

        $this->response->assertStatus(404);
    }
}
