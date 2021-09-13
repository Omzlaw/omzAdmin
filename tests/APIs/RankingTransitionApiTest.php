<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\RankingTransition;

class RankingTransitionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_ranking_transition()
    {
        $rankingTransition = RankingTransition::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/ranking_transitions', $rankingTransition
        );

        $this->assertApiResponse($rankingTransition);
    }

    /**
     * @test
     */
    public function test_read_ranking_transition()
    {
        $rankingTransition = RankingTransition::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/ranking_transitions/'.$rankingTransition->id
        );

        $this->assertApiResponse($rankingTransition->toArray());
    }

    /**
     * @test
     */
    public function test_update_ranking_transition()
    {
        $rankingTransition = RankingTransition::factory()->create();
        $editedRankingTransition = RankingTransition::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/ranking_transitions/'.$rankingTransition->id,
            $editedRankingTransition
        );

        $this->assertApiResponse($editedRankingTransition);
    }

    /**
     * @test
     */
    public function test_delete_ranking_transition()
    {
        $rankingTransition = RankingTransition::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/ranking_transitions/'.$rankingTransition->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/ranking_transitions/'.$rankingTransition->id
        );

        $this->response->assertStatus(404);
    }
}
