<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Referee;

class RefereeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_referee()
    {
        $referee = Referee::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/referees', $referee
        );

        $this->assertApiResponse($referee);
    }

    /**
     * @test
     */
    public function test_read_referee()
    {
        $referee = Referee::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/referees/'.$referee->id
        );

        $this->assertApiResponse($referee->toArray());
    }

    /**
     * @test
     */
    public function test_update_referee()
    {
        $referee = Referee::factory()->create();
        $editedReferee = Referee::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/referees/'.$referee->id,
            $editedReferee
        );

        $this->assertApiResponse($editedReferee);
    }

    /**
     * @test
     */
    public function test_delete_referee()
    {
        $referee = Referee::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/referees/'.$referee->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/referees/'.$referee->id
        );

        $this->response->assertStatus(404);
    }
}
