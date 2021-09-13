<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\InjuryType;

class InjuryTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_injury_type()
    {
        $injuryType = InjuryType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/injury_types', $injuryType
        );

        $this->assertApiResponse($injuryType);
    }

    /**
     * @test
     */
    public function test_read_injury_type()
    {
        $injuryType = InjuryType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/injury_types/'.$injuryType->id
        );

        $this->assertApiResponse($injuryType->toArray());
    }

    /**
     * @test
     */
    public function test_update_injury_type()
    {
        $injuryType = InjuryType::factory()->create();
        $editedInjuryType = InjuryType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/injury_types/'.$injuryType->id,
            $editedInjuryType
        );

        $this->assertApiResponse($editedInjuryType);
    }

    /**
     * @test
     */
    public function test_delete_injury_type()
    {
        $injuryType = InjuryType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/injury_types/'.$injuryType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/injury_types/'.$injuryType->id
        );

        $this->response->assertStatus(404);
    }
}
