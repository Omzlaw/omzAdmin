<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UnavailablePlayerType;

class UnavailablePlayerTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_unavailable_player_type()
    {
        $unavailablePlayerType = UnavailablePlayerType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/unavailable_player_types', $unavailablePlayerType
        );

        $this->assertApiResponse($unavailablePlayerType);
    }

    /**
     * @test
     */
    public function test_read_unavailable_player_type()
    {
        $unavailablePlayerType = UnavailablePlayerType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/unavailable_player_types/'.$unavailablePlayerType->id
        );

        $this->assertApiResponse($unavailablePlayerType->toArray());
    }

    /**
     * @test
     */
    public function test_update_unavailable_player_type()
    {
        $unavailablePlayerType = UnavailablePlayerType::factory()->create();
        $editedUnavailablePlayerType = UnavailablePlayerType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/unavailable_player_types/'.$unavailablePlayerType->id,
            $editedUnavailablePlayerType
        );

        $this->assertApiResponse($editedUnavailablePlayerType);
    }

    /**
     * @test
     */
    public function test_delete_unavailable_player_type()
    {
        $unavailablePlayerType = UnavailablePlayerType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/unavailable_player_types/'.$unavailablePlayerType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/unavailable_player_types/'.$unavailablePlayerType->id
        );

        $this->response->assertStatus(404);
    }
}
