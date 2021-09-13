<?php namespace Tests\Repositories;

use App\Models\JerseySetPlayer;
use App\Repositories\JerseySetPlayerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class JerseySetPlayerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var JerseySetPlayerRepository
     */
    protected $jerseySetPlayerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->jerseySetPlayerRepo = \App::make(JerseySetPlayerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_jersey_set_player()
    {
        $jerseySetPlayer = JerseySetPlayer::factory()->make()->toArray();

        $createdJerseySetPlayer = $this->jerseySetPlayerRepo->create($jerseySetPlayer);

        $createdJerseySetPlayer = $createdJerseySetPlayer->toArray();
        $this->assertArrayHasKey('id', $createdJerseySetPlayer);
        $this->assertNotNull($createdJerseySetPlayer['id'], 'Created JerseySetPlayer must have id specified');
        $this->assertNotNull(JerseySetPlayer::find($createdJerseySetPlayer['id']), 'JerseySetPlayer with given id must be in DB');
        $this->assertModelData($jerseySetPlayer, $createdJerseySetPlayer);
    }

    /**
     * @test read
     */
    public function test_read_jersey_set_player()
    {
        $jerseySetPlayer = JerseySetPlayer::factory()->create();

        $dbJerseySetPlayer = $this->jerseySetPlayerRepo->find($jerseySetPlayer->id);

        $dbJerseySetPlayer = $dbJerseySetPlayer->toArray();
        $this->assertModelData($jerseySetPlayer->toArray(), $dbJerseySetPlayer);
    }

    /**
     * @test update
     */
    public function test_update_jersey_set_player()
    {
        $jerseySetPlayer = JerseySetPlayer::factory()->create();
        $fakeJerseySetPlayer = JerseySetPlayer::factory()->make()->toArray();

        $updatedJerseySetPlayer = $this->jerseySetPlayerRepo->update($fakeJerseySetPlayer, $jerseySetPlayer->id);

        $this->assertModelData($fakeJerseySetPlayer, $updatedJerseySetPlayer->toArray());
        $dbJerseySetPlayer = $this->jerseySetPlayerRepo->find($jerseySetPlayer->id);
        $this->assertModelData($fakeJerseySetPlayer, $dbJerseySetPlayer->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_jersey_set_player()
    {
        $jerseySetPlayer = JerseySetPlayer::factory()->create();

        $resp = $this->jerseySetPlayerRepo->delete($jerseySetPlayer->id);

        $this->assertTrue($resp);
        $this->assertNull(JerseySetPlayer::find($jerseySetPlayer->id), 'JerseySetPlayer should not exist in DB');
    }
}
