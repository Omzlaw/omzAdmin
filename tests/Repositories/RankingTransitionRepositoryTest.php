<?php namespace Tests\Repositories;

use App\Models\RankingTransition;
use App\Repositories\RankingTransitionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RankingTransitionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RankingTransitionRepository
     */
    protected $rankingTransitionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->rankingTransitionRepo = \App::make(RankingTransitionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_ranking_transition()
    {
        $rankingTransition = RankingTransition::factory()->make()->toArray();

        $createdRankingTransition = $this->rankingTransitionRepo->create($rankingTransition);

        $createdRankingTransition = $createdRankingTransition->toArray();
        $this->assertArrayHasKey('id', $createdRankingTransition);
        $this->assertNotNull($createdRankingTransition['id'], 'Created RankingTransition must have id specified');
        $this->assertNotNull(RankingTransition::find($createdRankingTransition['id']), 'RankingTransition with given id must be in DB');
        $this->assertModelData($rankingTransition, $createdRankingTransition);
    }

    /**
     * @test read
     */
    public function test_read_ranking_transition()
    {
        $rankingTransition = RankingTransition::factory()->create();

        $dbRankingTransition = $this->rankingTransitionRepo->find($rankingTransition->id);

        $dbRankingTransition = $dbRankingTransition->toArray();
        $this->assertModelData($rankingTransition->toArray(), $dbRankingTransition);
    }

    /**
     * @test update
     */
    public function test_update_ranking_transition()
    {
        $rankingTransition = RankingTransition::factory()->create();
        $fakeRankingTransition = RankingTransition::factory()->make()->toArray();

        $updatedRankingTransition = $this->rankingTransitionRepo->update($fakeRankingTransition, $rankingTransition->id);

        $this->assertModelData($fakeRankingTransition, $updatedRankingTransition->toArray());
        $dbRankingTransition = $this->rankingTransitionRepo->find($rankingTransition->id);
        $this->assertModelData($fakeRankingTransition, $dbRankingTransition->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_ranking_transition()
    {
        $rankingTransition = RankingTransition::factory()->create();

        $resp = $this->rankingTransitionRepo->delete($rankingTransition->id);

        $this->assertTrue($resp);
        $this->assertNull(RankingTransition::find($rankingTransition->id), 'RankingTransition should not exist in DB');
    }
}
