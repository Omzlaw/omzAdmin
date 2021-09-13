<?php namespace Tests\Repositories;

use App\Models\MatchReferee;
use App\Repositories\MatchRefereeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MatchRefereeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MatchRefereeRepository
     */
    protected $matchRefereeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->matchRefereeRepo = \App::make(MatchRefereeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_match_referee()
    {
        $matchReferee = MatchReferee::factory()->make()->toArray();

        $createdMatchReferee = $this->matchRefereeRepo->create($matchReferee);

        $createdMatchReferee = $createdMatchReferee->toArray();
        $this->assertArrayHasKey('id', $createdMatchReferee);
        $this->assertNotNull($createdMatchReferee['id'], 'Created MatchReferee must have id specified');
        $this->assertNotNull(MatchReferee::find($createdMatchReferee['id']), 'MatchReferee with given id must be in DB');
        $this->assertModelData($matchReferee, $createdMatchReferee);
    }

    /**
     * @test read
     */
    public function test_read_match_referee()
    {
        $matchReferee = MatchReferee::factory()->create();

        $dbMatchReferee = $this->matchRefereeRepo->find($matchReferee->id);

        $dbMatchReferee = $dbMatchReferee->toArray();
        $this->assertModelData($matchReferee->toArray(), $dbMatchReferee);
    }

    /**
     * @test update
     */
    public function test_update_match_referee()
    {
        $matchReferee = MatchReferee::factory()->create();
        $fakeMatchReferee = MatchReferee::factory()->make()->toArray();

        $updatedMatchReferee = $this->matchRefereeRepo->update($fakeMatchReferee, $matchReferee->id);

        $this->assertModelData($fakeMatchReferee, $updatedMatchReferee->toArray());
        $dbMatchReferee = $this->matchRefereeRepo->find($matchReferee->id);
        $this->assertModelData($fakeMatchReferee, $dbMatchReferee->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_match_referee()
    {
        $matchReferee = MatchReferee::factory()->create();

        $resp = $this->matchRefereeRepo->delete($matchReferee->id);

        $this->assertTrue($resp);
        $this->assertNull(MatchReferee::find($matchReferee->id), 'MatchReferee should not exist in DB');
    }
}
