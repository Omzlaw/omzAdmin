<?php namespace Tests\Repositories;

use App\Models\UnavailablePlayer;
use App\Repositories\UnavailablePlayerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UnavailablePlayerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UnavailablePlayerRepository
     */
    protected $unavailablePlayerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->unavailablePlayerRepo = \App::make(UnavailablePlayerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_unavailable_player()
    {
        $unavailablePlayer = UnavailablePlayer::factory()->make()->toArray();

        $createdUnavailablePlayer = $this->unavailablePlayerRepo->create($unavailablePlayer);

        $createdUnavailablePlayer = $createdUnavailablePlayer->toArray();
        $this->assertArrayHasKey('id', $createdUnavailablePlayer);
        $this->assertNotNull($createdUnavailablePlayer['id'], 'Created UnavailablePlayer must have id specified');
        $this->assertNotNull(UnavailablePlayer::find($createdUnavailablePlayer['id']), 'UnavailablePlayer with given id must be in DB');
        $this->assertModelData($unavailablePlayer, $createdUnavailablePlayer);
    }

    /**
     * @test read
     */
    public function test_read_unavailable_player()
    {
        $unavailablePlayer = UnavailablePlayer::factory()->create();

        $dbUnavailablePlayer = $this->unavailablePlayerRepo->find($unavailablePlayer->id);

        $dbUnavailablePlayer = $dbUnavailablePlayer->toArray();
        $this->assertModelData($unavailablePlayer->toArray(), $dbUnavailablePlayer);
    }

    /**
     * @test update
     */
    public function test_update_unavailable_player()
    {
        $unavailablePlayer = UnavailablePlayer::factory()->create();
        $fakeUnavailablePlayer = UnavailablePlayer::factory()->make()->toArray();

        $updatedUnavailablePlayer = $this->unavailablePlayerRepo->update($fakeUnavailablePlayer, $unavailablePlayer->id);

        $this->assertModelData($fakeUnavailablePlayer, $updatedUnavailablePlayer->toArray());
        $dbUnavailablePlayer = $this->unavailablePlayerRepo->find($unavailablePlayer->id);
        $this->assertModelData($fakeUnavailablePlayer, $dbUnavailablePlayer->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_unavailable_player()
    {
        $unavailablePlayer = UnavailablePlayer::factory()->create();

        $resp = $this->unavailablePlayerRepo->delete($unavailablePlayer->id);

        $this->assertTrue($resp);
        $this->assertNull(UnavailablePlayer::find($unavailablePlayer->id), 'UnavailablePlayer should not exist in DB');
    }
}
