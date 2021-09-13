<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SquadPlayer;

class SquadPlayerApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_squad_player()
    {
        $squadPlayer = SquadPlayer::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/squad_players', $squadPlayer
        );

        $this->assertApiResponse($squadPlayer);
    }

    /**
     * @test
     */
    public function test_read_squad_player()
    {
        $squadPlayer = SquadPlayer::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/squad_players/'.$squadPlayer->id
        );

        $this->assertApiResponse($squadPlayer->toArray());
    }

    /**
     * @test
     */
    public function test_update_squad_player()
    {
        $squadPlayer = SquadPlayer::factory()->create();
        $editedSquadPlayer = SquadPlayer::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/squad_players/'.$squadPlayer->id,
            $editedSquadPlayer
        );

        $this->assertApiResponse($editedSquadPlayer);
    }

    /**
     * @test
     */
    public function test_delete_squad_player()
    {
        $squadPlayer = SquadPlayer::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/squad_players/'.$squadPlayer->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/squad_players/'.$squadPlayer->id
        );

        $this->response->assertStatus(404);
    }
}
