<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Injury;

class InjuryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_injury()
    {
        $injury = Injury::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/injuries', $injury
        );

        $this->assertApiResponse($injury);
    }

    /**
     * @test
     */
    public function test_read_injury()
    {
        $injury = Injury::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/injuries/'.$injury->id
        );

        $this->assertApiResponse($injury->toArray());
    }

    /**
     * @test
     */
    public function test_update_injury()
    {
        $injury = Injury::factory()->create();
        $editedInjury = Injury::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/injuries/'.$injury->id,
            $editedInjury
        );

        $this->assertApiResponse($editedInjury);
    }

    /**
     * @test
     */
    public function test_delete_injury()
    {
        $injury = Injury::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/injuries/'.$injury->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/injuries/'.$injury->id
        );

        $this->response->assertStatus(404);
    }
}
