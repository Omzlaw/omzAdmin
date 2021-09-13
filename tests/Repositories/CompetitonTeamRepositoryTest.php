<?php namespace Tests\Repositories;

use App\Models\CompetitonTeam;
use App\Repositories\CompetitonTeamRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CompetitonTeamRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CompetitonTeamRepository
     */
    protected $competitonTeamRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->competitonTeamRepo = \App::make(CompetitonTeamRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_competiton_team()
    {
        $competitonTeam = CompetitonTeam::factory()->make()->toArray();

        $createdCompetitonTeam = $this->competitonTeamRepo->create($competitonTeam);

        $createdCompetitonTeam = $createdCompetitonTeam->toArray();
        $this->assertArrayHasKey('id', $createdCompetitonTeam);
        $this->assertNotNull($createdCompetitonTeam['id'], 'Created CompetitonTeam must have id specified');
        $this->assertNotNull(CompetitonTeam::find($createdCompetitonTeam['id']), 'CompetitonTeam with given id must be in DB');
        $this->assertModelData($competitonTeam, $createdCompetitonTeam);
    }

    /**
     * @test read
     */
    public function test_read_competiton_team()
    {
        $competitonTeam = CompetitonTeam::factory()->create();

        $dbCompetitonTeam = $this->competitonTeamRepo->find($competitonTeam->id);

        $dbCompetitonTeam = $dbCompetitonTeam->toArray();
        $this->assertModelData($competitonTeam->toArray(), $dbCompetitonTeam);
    }

    /**
     * @test update
     */
    public function test_update_competiton_team()
    {
        $competitonTeam = CompetitonTeam::factory()->create();
        $fakeCompetitonTeam = CompetitonTeam::factory()->make()->toArray();

        $updatedCompetitonTeam = $this->competitonTeamRepo->update($fakeCompetitonTeam, $competitonTeam->id);

        $this->assertModelData($fakeCompetitonTeam, $updatedCompetitonTeam->toArray());
        $dbCompetitonTeam = $this->competitonTeamRepo->find($competitonTeam->id);
        $this->assertModelData($fakeCompetitonTeam, $dbCompetitonTeam->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_competiton_team()
    {
        $competitonTeam = CompetitonTeam::factory()->create();

        $resp = $this->competitonTeamRepo->delete($competitonTeam->id);

        $this->assertTrue($resp);
        $this->assertNull(CompetitonTeam::find($competitonTeam->id), 'CompetitonTeam should not exist in DB');
    }
}
