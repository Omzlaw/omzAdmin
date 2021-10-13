<?php namespace Tests\Repositories;

use App\Models\Broadcast;
use App\Repositories\BroadcastRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BroadcastRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BroadcastRepository
     */
    protected $broadcastRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->broadcastRepo = \App::make(BroadcastRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_broadcast()
    {
        $broadcast = Broadcast::factory()->make()->toArray();

        $createdBroadcast = $this->broadcastRepo->create($broadcast);

        $createdBroadcast = $createdBroadcast->toArray();
        $this->assertArrayHasKey('id', $createdBroadcast);
        $this->assertNotNull($createdBroadcast['id'], 'Created Broadcast must have id specified');
        $this->assertNotNull(Broadcast::find($createdBroadcast['id']), 'Broadcast with given id must be in DB');
        $this->assertModelData($broadcast, $createdBroadcast);
    }

    /**
     * @test read
     */
    public function test_read_broadcast()
    {
        $broadcast = Broadcast::factory()->create();

        $dbBroadcast = $this->broadcastRepo->find($broadcast->id);

        $dbBroadcast = $dbBroadcast->toArray();
        $this->assertModelData($broadcast->toArray(), $dbBroadcast);
    }

    /**
     * @test update
     */
    public function test_update_broadcast()
    {
        $broadcast = Broadcast::factory()->create();
        $fakeBroadcast = Broadcast::factory()->make()->toArray();

        $updatedBroadcast = $this->broadcastRepo->update($fakeBroadcast, $broadcast->id);

        $this->assertModelData($fakeBroadcast, $updatedBroadcast->toArray());
        $dbBroadcast = $this->broadcastRepo->find($broadcast->id);
        $this->assertModelData($fakeBroadcast, $dbBroadcast->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_broadcast()
    {
        $broadcast = Broadcast::factory()->create();

        $resp = $this->broadcastRepo->delete($broadcast->id);

        $this->assertTrue($resp);
        $this->assertNull(Broadcast::find($broadcast->id), 'Broadcast should not exist in DB');
    }
}
