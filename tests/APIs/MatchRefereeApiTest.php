<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MatchReferee;

class MatchRefereeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_match_referee()
    {
        $matchReferee = MatchReferee::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/match_referees', $matchReferee
        );

        $this->assertApiResponse($matchReferee);
    }

    /**
     * @test
     */
    public function test_read_match_referee()
    {
        $matchReferee = MatchReferee::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/match_referees/'.$matchReferee->id
        );

        $this->assertApiResponse($matchReferee->toArray());
    }

    /**
     * @test
     */
    public function test_update_match_referee()
    {
        $matchReferee = MatchReferee::factory()->create();
        $editedMatchReferee = MatchReferee::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/match_referees/'.$matchReferee->id,
            $editedMatchReferee
        );

        $this->assertApiResponse($editedMatchReferee);
    }

    /**
     * @test
     */
    public function test_delete_match_referee()
    {
        $matchReferee = MatchReferee::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/match_referees/'.$matchReferee->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/match_referees/'.$matchReferee->id
        );

        $this->response->assertStatus(404);
    }
}
