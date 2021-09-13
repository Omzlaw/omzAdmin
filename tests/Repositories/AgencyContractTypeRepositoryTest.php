<?php namespace Tests\Repositories;

use App\Models\AgencyContractType;
use App\Repositories\AgencyContractTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AgencyContractTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AgencyContractTypeRepository
     */
    protected $agencyContractTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->agencyContractTypeRepo = \App::make(AgencyContractTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_agency_contract_type()
    {
        $agencyContractType = AgencyContractType::factory()->make()->toArray();

        $createdAgencyContractType = $this->agencyContractTypeRepo->create($agencyContractType);

        $createdAgencyContractType = $createdAgencyContractType->toArray();
        $this->assertArrayHasKey('id', $createdAgencyContractType);
        $this->assertNotNull($createdAgencyContractType['id'], 'Created AgencyContractType must have id specified');
        $this->assertNotNull(AgencyContractType::find($createdAgencyContractType['id']), 'AgencyContractType with given id must be in DB');
        $this->assertModelData($agencyContractType, $createdAgencyContractType);
    }

    /**
     * @test read
     */
    public function test_read_agency_contract_type()
    {
        $agencyContractType = AgencyContractType::factory()->create();

        $dbAgencyContractType = $this->agencyContractTypeRepo->find($agencyContractType->id);

        $dbAgencyContractType = $dbAgencyContractType->toArray();
        $this->assertModelData($agencyContractType->toArray(), $dbAgencyContractType);
    }

    /**
     * @test update
     */
    public function test_update_agency_contract_type()
    {
        $agencyContractType = AgencyContractType::factory()->create();
        $fakeAgencyContractType = AgencyContractType::factory()->make()->toArray();

        $updatedAgencyContractType = $this->agencyContractTypeRepo->update($fakeAgencyContractType, $agencyContractType->id);

        $this->assertModelData($fakeAgencyContractType, $updatedAgencyContractType->toArray());
        $dbAgencyContractType = $this->agencyContractTypeRepo->find($agencyContractType->id);
        $this->assertModelData($fakeAgencyContractType, $dbAgencyContractType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_agency_contract_type()
    {
        $agencyContractType = AgencyContractType::factory()->create();

        $resp = $this->agencyContractTypeRepo->delete($agencyContractType->id);

        $this->assertTrue($resp);
        $this->assertNull(AgencyContractType::find($agencyContractType->id), 'AgencyContractType should not exist in DB');
    }
}
