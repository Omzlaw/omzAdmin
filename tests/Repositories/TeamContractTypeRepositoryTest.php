<?php namespace Tests\Repositories;

use App\Models\TeamContractType;
use App\Repositories\TeamContractTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TeamContractTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TeamContractTypeRepository
     */
    protected $teamContractTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->teamContractTypeRepo = \App::make(TeamContractTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_team_contract_type()
    {
        $teamContractType = TeamContractType::factory()->make()->toArray();

        $createdTeamContractType = $this->teamContractTypeRepo->create($teamContractType);

        $createdTeamContractType = $createdTeamContractType->toArray();
        $this->assertArrayHasKey('id', $createdTeamContractType);
        $this->assertNotNull($createdTeamContractType['id'], 'Created TeamContractType must have id specified');
        $this->assertNotNull(TeamContractType::find($createdTeamContractType['id']), 'TeamContractType with given id must be in DB');
        $this->assertModelData($teamContractType, $createdTeamContractType);
    }

    /**
     * @test read
     */
    public function test_read_team_contract_type()
    {
        $teamContractType = TeamContractType::factory()->create();

        $dbTeamContractType = $this->teamContractTypeRepo->find($teamContractType->id);

        $dbTeamContractType = $dbTeamContractType->toArray();
        $this->assertModelData($teamContractType->toArray(), $dbTeamContractType);
    }

    /**
     * @test update
     */
    public function test_update_team_contract_type()
    {
        $teamContractType = TeamContractType::factory()->create();
        $fakeTeamContractType = TeamContractType::factory()->make()->toArray();

        $updatedTeamContractType = $this->teamContractTypeRepo->update($fakeTeamContractType, $teamContractType->id);

        $this->assertModelData($fakeTeamContractType, $updatedTeamContractType->toArray());
        $dbTeamContractType = $this->teamContractTypeRepo->find($teamContractType->id);
        $this->assertModelData($fakeTeamContractType, $dbTeamContractType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_team_contract_type()
    {
        $teamContractType = TeamContractType::factory()->create();

        $resp = $this->teamContractTypeRepo->delete($teamContractType->id);

        $this->assertTrue($resp);
        $this->assertNull(TeamContractType::find($teamContractType->id), 'TeamContractType should not exist in DB');
    }
}
