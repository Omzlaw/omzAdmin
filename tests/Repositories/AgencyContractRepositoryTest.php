<?php namespace Tests\Repositories;

use App\Models\AgencyContract;
use App\Repositories\AgencyContractRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AgencyContractRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AgencyContractRepository
     */
    protected $agencyContractRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->agencyContractRepo = \App::make(AgencyContractRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_agency_contract()
    {
        $agencyContract = AgencyContract::factory()->make()->toArray();

        $createdAgencyContract = $this->agencyContractRepo->create($agencyContract);

        $createdAgencyContract = $createdAgencyContract->toArray();
        $this->assertArrayHasKey('id', $createdAgencyContract);
        $this->assertNotNull($createdAgencyContract['id'], 'Created AgencyContract must have id specified');
        $this->assertNotNull(AgencyContract::find($createdAgencyContract['id']), 'AgencyContract with given id must be in DB');
        $this->assertModelData($agencyContract, $createdAgencyContract);
    }

    /**
     * @test read
     */
    public function test_read_agency_contract()
    {
        $agencyContract = AgencyContract::factory()->create();

        $dbAgencyContract = $this->agencyContractRepo->find($agencyContract->id);

        $dbAgencyContract = $dbAgencyContract->toArray();
        $this->assertModelData($agencyContract->toArray(), $dbAgencyContract);
    }

    /**
     * @test update
     */
    public function test_update_agency_contract()
    {
        $agencyContract = AgencyContract::factory()->create();
        $fakeAgencyContract = AgencyContract::factory()->make()->toArray();

        $updatedAgencyContract = $this->agencyContractRepo->update($fakeAgencyContract, $agencyContract->id);

        $this->assertModelData($fakeAgencyContract, $updatedAgencyContract->toArray());
        $dbAgencyContract = $this->agencyContractRepo->find($agencyContract->id);
        $this->assertModelData($fakeAgencyContract, $dbAgencyContract->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_agency_contract()
    {
        $agencyContract = AgencyContract::factory()->create();

        $resp = $this->agencyContractRepo->delete($agencyContract->id);

        $this->assertTrue($resp);
        $this->assertNull(AgencyContract::find($agencyContract->id), 'AgencyContract should not exist in DB');
    }
}
