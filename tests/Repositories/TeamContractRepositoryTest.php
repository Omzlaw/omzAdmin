<?php namespace Tests\Repositories;

use App\Models\TeamContract;
use App\Repositories\TeamContractRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TeamContractRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TeamContractRepository
     */
    protected $teamContractRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->teamContractRepo = \App::make(TeamContractRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_team_contract()
    {
        $teamContract = TeamContract::factory()->make()->toArray();

        $createdTeamContract = $this->teamContractRepo->create($teamContract);

        $createdTeamContract = $createdTeamContract->toArray();
        $this->assertArrayHasKey('id', $createdTeamContract);
        $this->assertNotNull($createdTeamContract['id'], 'Created TeamContract must have id specified');
        $this->assertNotNull(TeamContract::find($createdTeamContract['id']), 'TeamContract with given id must be in DB');
        $this->assertModelData($teamContract, $createdTeamContract);
    }

    /**
     * @test read
     */
    public function test_read_team_contract()
    {
        $teamContract = TeamContract::factory()->create();

        $dbTeamContract = $this->teamContractRepo->find($teamContract->id);

        $dbTeamContract = $dbTeamContract->toArray();
        $this->assertModelData($teamContract->toArray(), $dbTeamContract);
    }

    /**
     * @test update
     */
    public function test_update_team_contract()
    {
        $teamContract = TeamContract::factory()->create();
        $fakeTeamContract = TeamContract::factory()->make()->toArray();

        $updatedTeamContract = $this->teamContractRepo->update($fakeTeamContract, $teamContract->id);

        $this->assertModelData($fakeTeamContract, $updatedTeamContract->toArray());
        $dbTeamContract = $this->teamContractRepo->find($teamContract->id);
        $this->assertModelData($fakeTeamContract, $dbTeamContract->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_team_contract()
    {
        $teamContract = TeamContract::factory()->create();

        $resp = $this->teamContractRepo->delete($teamContract->id);

        $this->assertTrue($resp);
        $this->assertNull(TeamContract::find($teamContract->id), 'TeamContract should not exist in DB');
    }
}
