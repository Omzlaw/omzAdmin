<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AgencyContract;

class AgencyContractApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_agency_contract()
    {
        $agencyContract = AgencyContract::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/agency_contracts', $agencyContract
        );

        $this->assertApiResponse($agencyContract);
    }

    /**
     * @test
     */
    public function test_read_agency_contract()
    {
        $agencyContract = AgencyContract::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/agency_contracts/'.$agencyContract->id
        );

        $this->assertApiResponse($agencyContract->toArray());
    }

    /**
     * @test
     */
    public function test_update_agency_contract()
    {
        $agencyContract = AgencyContract::factory()->create();
        $editedAgencyContract = AgencyContract::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/agency_contracts/'.$agencyContract->id,
            $editedAgencyContract
        );

        $this->assertApiResponse($editedAgencyContract);
    }

    /**
     * @test
     */
    public function test_delete_agency_contract()
    {
        $agencyContract = AgencyContract::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/agency_contracts/'.$agencyContract->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/agency_contracts/'.$agencyContract->id
        );

        $this->response->assertStatus(404);
    }
}
