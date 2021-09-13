<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TeamContract;

class TeamContractApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_team_contract()
    {
        $teamContract = TeamContract::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/team_contracts', $teamContract
        );

        $this->assertApiResponse($teamContract);
    }

    /**
     * @test
     */
    public function test_read_team_contract()
    {
        $teamContract = TeamContract::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/team_contracts/'.$teamContract->id
        );

        $this->assertApiResponse($teamContract->toArray());
    }

    /**
     * @test
     */
    public function test_update_team_contract()
    {
        $teamContract = TeamContract::factory()->create();
        $editedTeamContract = TeamContract::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/team_contracts/'.$teamContract->id,
            $editedTeamContract
        );

        $this->assertApiResponse($editedTeamContract);
    }

    /**
     * @test
     */
    public function test_delete_team_contract()
    {
        $teamContract = TeamContract::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/team_contracts/'.$teamContract->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/team_contracts/'.$teamContract->id
        );

        $this->response->assertStatus(404);
    }
}
