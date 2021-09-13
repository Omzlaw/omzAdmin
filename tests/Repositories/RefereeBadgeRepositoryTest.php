<?php namespace Tests\Repositories;

use App\Models\RefereeBadge;
use App\Repositories\RefereeBadgeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RefereeBadgeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RefereeBadgeRepository
     */
    protected $refereeBadgeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->refereeBadgeRepo = \App::make(RefereeBadgeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_referee_badge()
    {
        $refereeBadge = RefereeBadge::factory()->make()->toArray();

        $createdRefereeBadge = $this->refereeBadgeRepo->create($refereeBadge);

        $createdRefereeBadge = $createdRefereeBadge->toArray();
        $this->assertArrayHasKey('id', $createdRefereeBadge);
        $this->assertNotNull($createdRefereeBadge['id'], 'Created RefereeBadge must have id specified');
        $this->assertNotNull(RefereeBadge::find($createdRefereeBadge['id']), 'RefereeBadge with given id must be in DB');
        $this->assertModelData($refereeBadge, $createdRefereeBadge);
    }

    /**
     * @test read
     */
    public function test_read_referee_badge()
    {
        $refereeBadge = RefereeBadge::factory()->create();

        $dbRefereeBadge = $this->refereeBadgeRepo->find($refereeBadge->id);

        $dbRefereeBadge = $dbRefereeBadge->toArray();
        $this->assertModelData($refereeBadge->toArray(), $dbRefereeBadge);
    }

    /**
     * @test update
     */
    public function test_update_referee_badge()
    {
        $refereeBadge = RefereeBadge::factory()->create();
        $fakeRefereeBadge = RefereeBadge::factory()->make()->toArray();

        $updatedRefereeBadge = $this->refereeBadgeRepo->update($fakeRefereeBadge, $refereeBadge->id);

        $this->assertModelData($fakeRefereeBadge, $updatedRefereeBadge->toArray());
        $dbRefereeBadge = $this->refereeBadgeRepo->find($refereeBadge->id);
        $this->assertModelData($fakeRefereeBadge, $dbRefereeBadge->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_referee_badge()
    {
        $refereeBadge = RefereeBadge::factory()->create();

        $resp = $this->refereeBadgeRepo->delete($refereeBadge->id);

        $this->assertTrue($resp);
        $this->assertNull(RefereeBadge::find($refereeBadge->id), 'RefereeBadge should not exist in DB');
    }
}
