<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TrophyType;

class TrophyTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_trophy_type()
    {
        $trophyType = TrophyType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/trophy_types', $trophyType
        );

        $this->assertApiResponse($trophyType);
    }

    /**
     * @test
     */
    public function test_read_trophy_type()
    {
        $trophyType = TrophyType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/trophy_types/'.$trophyType->id
        );

        $this->assertApiResponse($trophyType->toArray());
    }

    /**
     * @test
     */
    public function test_update_trophy_type()
    {
        $trophyType = TrophyType::factory()->create();
        $editedTrophyType = TrophyType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/trophy_types/'.$trophyType->id,
            $editedTrophyType
        );

        $this->assertApiResponse($editedTrophyType);
    }

    /**
     * @test
     */
    public function test_delete_trophy_type()
    {
        $trophyType = TrophyType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/trophy_types/'.$trophyType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/trophy_types/'.$trophyType->id
        );

        $this->response->assertStatus(404);
    }
}
