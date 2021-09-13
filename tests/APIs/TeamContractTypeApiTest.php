<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TeamContractType;

class TeamContractTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_team_contract_type()
    {
        $teamContractType = TeamContractType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/team_contract_types', $teamContractType
        );

        $this->assertApiResponse($teamContractType);
    }

    /**
     * @test
     */
    public function test_read_team_contract_type()
    {
        $teamContractType = TeamContractType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/team_contract_types/'.$teamContractType->id
        );

        $this->assertApiResponse($teamContractType->toArray());
    }

    /**
     * @test
     */
    public function test_update_team_contract_type()
    {
        $teamContractType = TeamContractType::factory()->create();
        $editedTeamContractType = TeamContractType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/team_contract_types/'.$teamContractType->id,
            $editedTeamContractType
        );

        $this->assertApiResponse($editedTeamContractType);
    }

    /**
     * @test
     */
    public function test_delete_team_contract_type()
    {
        $teamContractType = TeamContractType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/team_contract_types/'.$teamContractType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/team_contract_types/'.$teamContractType->id
        );

        $this->response->assertStatus(404);
    }
}
