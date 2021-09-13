<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CompetitonTeam;

class CompetitonTeamApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_competiton_team()
    {
        $competitonTeam = CompetitonTeam::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/competiton_teams', $competitonTeam
        );

        $this->assertApiResponse($competitonTeam);
    }

    /**
     * @test
     */
    public function test_read_competiton_team()
    {
        $competitonTeam = CompetitonTeam::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/competiton_teams/'.$competitonTeam->id
        );

        $this->assertApiResponse($competitonTeam->toArray());
    }

    /**
     * @test
     */
    public function test_update_competiton_team()
    {
        $competitonTeam = CompetitonTeam::factory()->create();
        $editedCompetitonTeam = CompetitonTeam::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/competiton_teams/'.$competitonTeam->id,
            $editedCompetitonTeam
        );

        $this->assertApiResponse($editedCompetitonTeam);
    }

    /**
     * @test
     */
    public function test_delete_competiton_team()
    {
        $competitonTeam = CompetitonTeam::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/competiton_teams/'.$competitonTeam->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/competiton_teams/'.$competitonTeam->id
        );

        $this->response->assertStatus(404);
    }
}
