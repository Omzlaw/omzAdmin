<?php namespace Tests\Repositories;

use App\Models\RefereeBadgeType;
use App\Repositories\RefereeBadgeTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RefereeBadgeTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RefereeBadgeTypeRepository
     */
    protected $refereeBadgeTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->refereeBadgeTypeRepo = \App::make(RefereeBadgeTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_referee_badge_type()
    {
        $refereeBadgeType = RefereeBadgeType::factory()->make()->toArray();

        $createdRefereeBadgeType = $this->refereeBadgeTypeRepo->create($refereeBadgeType);

        $createdRefereeBadgeType = $createdRefereeBadgeType->toArray();
        $this->assertArrayHasKey('id', $createdRefereeBadgeType);
        $this->assertNotNull($createdRefereeBadgeType['id'], 'Created RefereeBadgeType must have id specified');
        $this->assertNotNull(RefereeBadgeType::find($createdRefereeBadgeType['id']), 'RefereeBadgeType with given id must be in DB');
        $this->assertModelData($refereeBadgeType, $createdRefereeBadgeType);
    }

    /**
     * @test read
     */
    public function test_read_referee_badge_type()
    {
        $refereeBadgeType = RefereeBadgeType::factory()->create();

        $dbRefereeBadgeType = $this->refereeBadgeTypeRepo->find($refereeBadgeType->id);

        $dbRefereeBadgeType = $dbRefereeBadgeType->toArray();
        $this->assertModelData($refereeBadgeType->toArray(), $dbRefereeBadgeType);
    }

    /**
     * @test update
     */
    public function test_update_referee_badge_type()
    {
        $refereeBadgeType = RefereeBadgeType::factory()->create();
        $fakeRefereeBadgeType = RefereeBadgeType::factory()->make()->toArray();

        $updatedRefereeBadgeType = $this->refereeBadgeTypeRepo->update($fakeRefereeBadgeType, $refereeBadgeType->id);

        $this->assertModelData($fakeRefereeBadgeType, $updatedRefereeBadgeType->toArray());
        $dbRefereeBadgeType = $this->refereeBadgeTypeRepo->find($refereeBadgeType->id);
        $this->assertModelData($fakeRefereeBadgeType, $dbRefereeBadgeType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_referee_badge_type()
    {
        $refereeBadgeType = RefereeBadgeType::factory()->create();

        $resp = $this->refereeBadgeTypeRepo->delete($refereeBadgeType->id);

        $this->assertTrue($resp);
        $this->assertNull(RefereeBadgeType::find($refereeBadgeType->id), 'RefereeBadgeType should not exist in DB');
    }
}
