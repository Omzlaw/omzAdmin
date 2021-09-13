<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Trophy;

class TrophyApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_trophy()
    {
        $trophy = Trophy::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/trophies', $trophy
        );

        $this->assertApiResponse($trophy);
    }

    /**
     * @test
     */
    public function test_read_trophy()
    {
        $trophy = Trophy::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/trophies/'.$trophy->id
        );

        $this->assertApiResponse($trophy->toArray());
    }

    /**
     * @test
     */
    public function test_update_trophy()
    {
        $trophy = Trophy::factory()->create();
        $editedTrophy = Trophy::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/trophies/'.$trophy->id,
            $editedTrophy
        );

        $this->assertApiResponse($editedTrophy);
    }

    /**
     * @test
     */
    public function test_delete_trophy()
    {
        $trophy = Trophy::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/trophies/'.$trophy->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/trophies/'.$trophy->id
        );

        $this->response->assertStatus(404);
    }
}
