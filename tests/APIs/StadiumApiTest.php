<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Stadium;

class StadiumApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stadium()
    {
        $stadium = Stadium::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/stadia', $stadium
        );

        $this->assertApiResponse($stadium);
    }

    /**
     * @test
     */
    public function test_read_stadium()
    {
        $stadium = Stadium::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/stadia/'.$stadium->id
        );

        $this->assertApiResponse($stadium->toArray());
    }

    /**
     * @test
     */
    public function test_update_stadium()
    {
        $stadium = Stadium::factory()->create();
        $editedStadium = Stadium::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/stadia/'.$stadium->id,
            $editedStadium
        );

        $this->assertApiResponse($editedStadium);
    }

    /**
     * @test
     */
    public function test_delete_stadium()
    {
        $stadium = Stadium::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/stadia/'.$stadium->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/stadia/'.$stadium->id
        );

        $this->response->assertStatus(404);
    }
}
