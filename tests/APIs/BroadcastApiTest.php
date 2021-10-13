<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Broadcast;

class BroadcastApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_broadcast()
    {
        $broadcast = Broadcast::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/broadcasts', $broadcast
        );

        $this->assertApiResponse($broadcast);
    }

    /**
     * @test
     */
    public function test_read_broadcast()
    {
        $broadcast = Broadcast::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/broadcasts/'.$broadcast->id
        );

        $this->assertApiResponse($broadcast->toArray());
    }

    /**
     * @test
     */
    public function test_update_broadcast()
    {
        $broadcast = Broadcast::factory()->create();
        $editedBroadcast = Broadcast::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/broadcasts/'.$broadcast->id,
            $editedBroadcast
        );

        $this->assertApiResponse($editedBroadcast);
    }

    /**
     * @test
     */
    public function test_delete_broadcast()
    {
        $broadcast = Broadcast::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/broadcasts/'.$broadcast->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/broadcasts/'.$broadcast->id
        );

        $this->response->assertStatus(404);
    }
}
