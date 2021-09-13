<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Match;

class MatchApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_match()
    {
        $match = Match::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/matches', $match
        );

        $this->assertApiResponse($match);
    }

    /**
     * @test
     */
    public function test_read_match()
    {
        $match = Match::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/matches/'.$match->id
        );

        $this->assertApiResponse($match->toArray());
    }

    /**
     * @test
     */
    public function test_update_match()
    {
        $match = Match::factory()->create();
        $editedMatch = Match::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/matches/'.$match->id,
            $editedMatch
        );

        $this->assertApiResponse($editedMatch);
    }

    /**
     * @test
     */
    public function test_delete_match()
    {
        $match = Match::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/matches/'.$match->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/matches/'.$match->id
        );

        $this->response->assertStatus(404);
    }
}
