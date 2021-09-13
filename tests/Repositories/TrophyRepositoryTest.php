<?php namespace Tests\Repositories;

use App\Models\Trophy;
use App\Repositories\TrophyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TrophyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TrophyRepository
     */
    protected $trophyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->trophyRepo = \App::make(TrophyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_trophy()
    {
        $trophy = Trophy::factory()->make()->toArray();

        $createdTrophy = $this->trophyRepo->create($trophy);

        $createdTrophy = $createdTrophy->toArray();
        $this->assertArrayHasKey('id', $createdTrophy);
        $this->assertNotNull($createdTrophy['id'], 'Created Trophy must have id specified');
        $this->assertNotNull(Trophy::find($createdTrophy['id']), 'Trophy with given id must be in DB');
        $this->assertModelData($trophy, $createdTrophy);
    }

    /**
     * @test read
     */
    public function test_read_trophy()
    {
        $trophy = Trophy::factory()->create();

        $dbTrophy = $this->trophyRepo->find($trophy->id);

        $dbTrophy = $dbTrophy->toArray();
        $this->assertModelData($trophy->toArray(), $dbTrophy);
    }

    /**
     * @test update
     */
    public function test_update_trophy()
    {
        $trophy = Trophy::factory()->create();
        $fakeTrophy = Trophy::factory()->make()->toArray();

        $updatedTrophy = $this->trophyRepo->update($fakeTrophy, $trophy->id);

        $this->assertModelData($fakeTrophy, $updatedTrophy->toArray());
        $dbTrophy = $this->trophyRepo->find($trophy->id);
        $this->assertModelData($fakeTrophy, $dbTrophy->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_trophy()
    {
        $trophy = Trophy::factory()->create();

        $resp = $this->trophyRepo->delete($trophy->id);

        $this->assertTrue($resp);
        $this->assertNull(Trophy::find($trophy->id), 'Trophy should not exist in DB');
    }
}
