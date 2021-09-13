<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\JerseySet;

class JerseySetApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_jersey_set()
    {
        $jerseySet = JerseySet::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/jersey_sets', $jerseySet
        );

        $this->assertApiResponse($jerseySet);
    }

    /**
     * @test
     */
    public function test_read_jersey_set()
    {
        $jerseySet = JerseySet::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/jersey_sets/'.$jerseySet->id
        );

        $this->assertApiResponse($jerseySet->toArray());
    }

    /**
     * @test
     */
    public function test_update_jersey_set()
    {
        $jerseySet = JerseySet::factory()->create();
        $editedJerseySet = JerseySet::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/jersey_sets/'.$jerseySet->id,
            $editedJerseySet
        );

        $this->assertApiResponse($editedJerseySet);
    }

    /**
     * @test
     */
    public function test_delete_jersey_set()
    {
        $jerseySet = JerseySet::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/jersey_sets/'.$jerseySet->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/jersey_sets/'.$jerseySet->id
        );

        $this->response->assertStatus(404);
    }
}
