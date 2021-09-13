<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\RefereeBadgeType;

class RefereeBadgeTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_referee_badge_type()
    {
        $refereeBadgeType = RefereeBadgeType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/referee_badge_types', $refereeBadgeType
        );

        $this->assertApiResponse($refereeBadgeType);
    }

    /**
     * @test
     */
    public function test_read_referee_badge_type()
    {
        $refereeBadgeType = RefereeBadgeType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/referee_badge_types/'.$refereeBadgeType->id
        );

        $this->assertApiResponse($refereeBadgeType->toArray());
    }

    /**
     * @test
     */
    public function test_update_referee_badge_type()
    {
        $refereeBadgeType = RefereeBadgeType::factory()->create();
        $editedRefereeBadgeType = RefereeBadgeType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/referee_badge_types/'.$refereeBadgeType->id,
            $editedRefereeBadgeType
        );

        $this->assertApiResponse($editedRefereeBadgeType);
    }

    /**
     * @test
     */
    public function test_delete_referee_badge_type()
    {
        $refereeBadgeType = RefereeBadgeType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/referee_badge_types/'.$refereeBadgeType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/referee_badge_types/'.$refereeBadgeType->id
        );

        $this->response->assertStatus(404);
    }
}
