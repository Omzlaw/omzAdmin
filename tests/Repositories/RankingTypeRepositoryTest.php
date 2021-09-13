<?php namespace Tests\Repositories;

use App\Models\RankingType;
use App\Repositories\RankingTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RankingTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RankingTypeRepository
     */
    protected $rankingTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->rankingTypeRepo = \App::make(RankingTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_ranking_type()
    {
        $rankingType = RankingType::factory()->make()->toArray();

        $createdRankingType = $this->rankingTypeRepo->create($rankingType);

        $createdRankingType = $createdRankingType->toArray();
        $this->assertArrayHasKey('id', $createdRankingType);
        $this->assertNotNull($createdRankingType['id'], 'Created RankingType must have id specified');
        $this->assertNotNull(RankingType::find($createdRankingType['id']), 'RankingType with given id must be in DB');
        $this->assertModelData($rankingType, $createdRankingType);
    }

    /**
     * @test read
     */
    public function test_read_ranking_type()
    {
        $rankingType = RankingType::factory()->create();

        $dbRankingType = $this->rankingTypeRepo->find($rankingType->id);

        $dbRankingType = $dbRankingType->toArray();
        $this->assertModelData($rankingType->toArray(), $dbRankingType);
    }

    /**
     * @test update
     */
    public function test_update_ranking_type()
    {
        $rankingType = RankingType::factory()->create();
        $fakeRankingType = RankingType::factory()->make()->toArray();

        $updatedRankingType = $this->rankingTypeRepo->update($fakeRankingType, $rankingType->id);

        $this->assertModelData($fakeRankingType, $updatedRankingType->toArray());
        $dbRankingType = $this->rankingTypeRepo->find($rankingType->id);
        $this->assertModelData($fakeRankingType, $dbRankingType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_ranking_type()
    {
        $rankingType = RankingType::factory()->create();

        $resp = $this->rankingTypeRepo->delete($rankingType->id);

        $this->assertTrue($resp);
        $this->assertNull(RankingType::find($rankingType->id), 'RankingType should not exist in DB');
    }
}
