<?php namespace Tests\Repositories;

use App\Models\Match;
use App\Repositories\MatchRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MatchRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MatchRepository
     */
    protected $matchRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->matchRepo = \App::make(MatchRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_match()
    {
        $match = Match::factory()->make()->toArray();

        $createdMatch = $this->matchRepo->create($match);

        $createdMatch = $createdMatch->toArray();
        $this->assertArrayHasKey('id', $createdMatch);
        $this->assertNotNull($createdMatch['id'], 'Created Match must have id specified');
        $this->assertNotNull(Match::find($createdMatch['id']), 'Match with given id must be in DB');
        $this->assertModelData($match, $createdMatch);
    }

    /**
     * @test read
     */
    public function test_read_match()
    {
        $match = Match::factory()->create();

        $dbMatch = $this->matchRepo->find($match->id);

        $dbMatch = $dbMatch->toArray();
        $this->assertModelData($match->toArray(), $dbMatch);
    }

    /**
     * @test update
     */
    public function test_update_match()
    {
        $match = Match::factory()->create();
        $fakeMatch = Match::factory()->make()->toArray();

        $updatedMatch = $this->matchRepo->update($fakeMatch, $match->id);

        $this->assertModelData($fakeMatch, $updatedMatch->toArray());
        $dbMatch = $this->matchRepo->find($match->id);
        $this->assertModelData($fakeMatch, $dbMatch->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_match()
    {
        $match = Match::factory()->create();

        $resp = $this->matchRepo->delete($match->id);

        $this->assertTrue($resp);
        $this->assertNull(Match::find($match->id), 'Match should not exist in DB');
    }
}
