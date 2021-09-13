<?php namespace Tests\Repositories;

use App\Models\SquadPlayer;
use App\Repositories\SquadPlayerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SquadPlayerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SquadPlayerRepository
     */
    protected $squadPlayerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->squadPlayerRepo = \App::make(SquadPlayerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_squad_player()
    {
        $squadPlayer = SquadPlayer::factory()->make()->toArray();

        $createdSquadPlayer = $this->squadPlayerRepo->create($squadPlayer);

        $createdSquadPlayer = $createdSquadPlayer->toArray();
        $this->assertArrayHasKey('id', $createdSquadPlayer);
        $this->assertNotNull($createdSquadPlayer['id'], 'Created SquadPlayer must have id specified');
        $this->assertNotNull(SquadPlayer::find($createdSquadPlayer['id']), 'SquadPlayer with given id must be in DB');
        $this->assertModelData($squadPlayer, $createdSquadPlayer);
    }

    /**
     * @test read
     */
    public function test_read_squad_player()
    {
        $squadPlayer = SquadPlayer::factory()->create();

        $dbSquadPlayer = $this->squadPlayerRepo->find($squadPlayer->id);

        $dbSquadPlayer = $dbSquadPlayer->toArray();
        $this->assertModelData($squadPlayer->toArray(), $dbSquadPlayer);
    }

    /**
     * @test update
     */
    public function test_update_squad_player()
    {
        $squadPlayer = SquadPlayer::factory()->create();
        $fakeSquadPlayer = SquadPlayer::factory()->make()->toArray();

        $updatedSquadPlayer = $this->squadPlayerRepo->update($fakeSquadPlayer, $squadPlayer->id);

        $this->assertModelData($fakeSquadPlayer, $updatedSquadPlayer->toArray());
        $dbSquadPlayer = $this->squadPlayerRepo->find($squadPlayer->id);
        $this->assertModelData($fakeSquadPlayer, $dbSquadPlayer->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_squad_player()
    {
        $squadPlayer = SquadPlayer::factory()->create();

        $resp = $this->squadPlayerRepo->delete($squadPlayer->id);

        $this->assertTrue($resp);
        $this->assertNull(SquadPlayer::find($squadPlayer->id), 'SquadPlayer should not exist in DB');
    }
}
