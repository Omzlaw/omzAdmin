<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Competition;

class CompetitionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_competition()
    {
        $competition = Competition::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/competitions', $competition
        );

        $this->assertApiResponse($competition);
    }

    /**
     * @test
     */
    public function test_read_competition()
    {
        $competition = Competition::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/competitions/'.$competition->id
        );

        $this->assertApiResponse($competition->toArray());
    }

    /**
     * @test
     */
    public function test_update_competition()
    {
        $competition = Competition::factory()->create();
        $editedCompetition = Competition::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/competitions/'.$competition->id,
            $editedCompetition
        );

        $this->assertApiResponse($editedCompetition);
    }

    /**
     * @test
     */
    public function test_delete_competition()
    {
        $competition = Competition::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/competitions/'.$competition->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/competitions/'.$competition->id
        );

        $this->response->assertStatus(404);
    }
}
