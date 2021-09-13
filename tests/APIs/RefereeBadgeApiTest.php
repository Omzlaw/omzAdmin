<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\RefereeBadge;

class RefereeBadgeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_referee_badge()
    {
        $refereeBadge = RefereeBadge::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/referee_badges', $refereeBadge
        );

        $this->assertApiResponse($refereeBadge);
    }

    /**
     * @test
     */
    public function test_read_referee_badge()
    {
        $refereeBadge = RefereeBadge::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/referee_badges/'.$refereeBadge->id
        );

        $this->assertApiResponse($refereeBadge->toArray());
    }

    /**
     * @test
     */
    public function test_update_referee_badge()
    {
        $refereeBadge = RefereeBadge::factory()->create();
        $editedRefereeBadge = RefereeBadge::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/referee_badges/'.$refereeBadge->id,
            $editedRefereeBadge
        );

        $this->assertApiResponse($editedRefereeBadge);
    }

    /**
     * @test
     */
    public function test_delete_referee_badge()
    {
        $refereeBadge = RefereeBadge::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/referee_badges/'.$refereeBadge->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/referee_badges/'.$refereeBadge->id
        );

        $this->response->assertStatus(404);
    }
}
