<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AgencyContractType;

class AgencyContractTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_agency_contract_type()
    {
        $agencyContractType = AgencyContractType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/agency_contract_types', $agencyContractType
        );

        $this->assertApiResponse($agencyContractType);
    }

    /**
     * @test
     */
    public function test_read_agency_contract_type()
    {
        $agencyContractType = AgencyContractType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/agency_contract_types/'.$agencyContractType->id
        );

        $this->assertApiResponse($agencyContractType->toArray());
    }

    /**
     * @test
     */
    public function test_update_agency_contract_type()
    {
        $agencyContractType = AgencyContractType::factory()->create();
        $editedAgencyContractType = AgencyContractType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/agency_contract_types/'.$agencyContractType->id,
            $editedAgencyContractType
        );

        $this->assertApiResponse($editedAgencyContractType);
    }

    /**
     * @test
     */
    public function test_delete_agency_contract_type()
    {
        $agencyContractType = AgencyContractType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/agency_contract_types/'.$agencyContractType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/agency_contract_types/'.$agencyContractType->id
        );

        $this->response->assertStatus(404);
    }
}
