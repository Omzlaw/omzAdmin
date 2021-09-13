<?php namespace Tests\Repositories;

use App\Models\Competition;
use App\Repositories\CompetitionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CompetitionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CompetitionRepository
     */
    protected $competitionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->competitionRepo = \App::make(CompetitionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_competition()
    {
        $competition = Competition::factory()->make()->toArray();

        $createdCompetition = $this->competitionRepo->create($competition);

        $createdCompetition = $createdCompetition->toArray();
        $this->assertArrayHasKey('id', $createdCompetition);
        $this->assertNotNull($createdCompetition['id'], 'Created Competition must have id specified');
        $this->assertNotNull(Competition::find($createdCompetition['id']), 'Competition with given id must be in DB');
        $this->assertModelData($competition, $createdCompetition);
    }

    /**
     * @test read
     */
    public function test_read_competition()
    {
        $competition = Competition::factory()->create();

        $dbCompetition = $this->competitionRepo->find($competition->id);

        $dbCompetition = $dbCompetition->toArray();
        $this->assertModelData($competition->toArray(), $dbCompetition);
    }

    /**
     * @test update
     */
    public function test_update_competition()
    {
        $competition = Competition::factory()->create();
        $fakeCompetition = Competition::factory()->make()->toArray();

        $updatedCompetition = $this->competitionRepo->update($fakeCompetition, $competition->id);

        $this->assertModelData($fakeCompetition, $updatedCompetition->toArray());
        $dbCompetition = $this->competitionRepo->find($competition->id);
        $this->assertModelData($fakeCompetition, $dbCompetition->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_competition()
    {
        $competition = Competition::factory()->create();

        $resp = $this->competitionRepo->delete($competition->id);

        $this->assertTrue($resp);
        $this->assertNull(Competition::find($competition->id), 'Competition should not exist in DB');
    }
}
