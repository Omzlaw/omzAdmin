<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\RankingType;

class RankingTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_ranking_type()
    {
        $rankingType = RankingType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/ranking_types', $rankingType
        );

        $this->assertApiResponse($rankingType);
    }

    /**
     * @test
     */
    public function test_read_ranking_type()
    {
        $rankingType = RankingType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/ranking_types/'.$rankingType->id
        );

        $this->assertApiResponse($rankingType->toArray());
    }

    /**
     * @test
     */
    public function test_update_ranking_type()
    {
        $rankingType = RankingType::factory()->create();
        $editedRankingType = RankingType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/ranking_types/'.$rankingType->id,
            $editedRankingType
        );

        $this->assertApiResponse($editedRankingType);
    }

    /**
     * @test
     */
    public function test_delete_ranking_type()
    {
        $rankingType = RankingType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/ranking_types/'.$rankingType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/ranking_types/'.$rankingType->id
        );

        $this->response->assertStatus(404);
    }
}
