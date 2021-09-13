<?php namespace Tests\Repositories;

use App\Models\Agency;
use App\Repositories\AgencyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AgencyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AgencyRepository
     */
    protected $agencyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->agencyRepo = \App::make(AgencyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_agency()
    {
        $agency = Agency::factory()->make()->toArray();

        $createdAgency = $this->agencyRepo->create($agency);

        $createdAgency = $createdAgency->toArray();
        $this->assertArrayHasKey('id', $createdAgency);
        $this->assertNotNull($createdAgency['id'], 'Created Agency must have id specified');
        $this->assertNotNull(Agency::find($createdAgency['id']), 'Agency with given id must be in DB');
        $this->assertModelData($agency, $createdAgency);
    }

    /**
     * @test read
     */
    public function test_read_agency()
    {
        $agency = Agency::factory()->create();

        $dbAgency = $this->agencyRepo->find($agency->id);

        $dbAgency = $dbAgency->toArray();
        $this->assertModelData($agency->toArray(), $dbAgency);
    }

    /**
     * @test update
     */
    public function test_update_agency()
    {
        $agency = Agency::factory()->create();
        $fakeAgency = Agency::factory()->make()->toArray();

        $updatedAgency = $this->agencyRepo->update($fakeAgency, $agency->id);

        $this->assertModelData($fakeAgency, $updatedAgency->toArray());
        $dbAgency = $this->agencyRepo->find($agency->id);
        $this->assertModelData($fakeAgency, $dbAgency->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_agency()
    {
        $agency = Agency::factory()->create();

        $resp = $this->agencyRepo->delete($agency->id);

        $this->assertTrue($resp);
        $this->assertNull(Agency::find($agency->id), 'Agency should not exist in DB');
    }
}
