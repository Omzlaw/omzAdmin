<?php namespace Tests\Repositories;

use App\Models\Stadium;
use App\Repositories\StadiumRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StadiumRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StadiumRepository
     */
    protected $stadiumRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->stadiumRepo = \App::make(StadiumRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_stadium()
    {
        $stadium = Stadium::factory()->make()->toArray();

        $createdStadium = $this->stadiumRepo->create($stadium);

        $createdStadium = $createdStadium->toArray();
        $this->assertArrayHasKey('id', $createdStadium);
        $this->assertNotNull($createdStadium['id'], 'Created Stadium must have id specified');
        $this->assertNotNull(Stadium::find($createdStadium['id']), 'Stadium with given id must be in DB');
        $this->assertModelData($stadium, $createdStadium);
    }

    /**
     * @test read
     */
    public function test_read_stadium()
    {
        $stadium = Stadium::factory()->create();

        $dbStadium = $this->stadiumRepo->find($stadium->id);

        $dbStadium = $dbStadium->toArray();
        $this->assertModelData($stadium->toArray(), $dbStadium);
    }

    /**
     * @test update
     */
    public function test_update_stadium()
    {
        $stadium = Stadium::factory()->create();
        $fakeStadium = Stadium::factory()->make()->toArray();

        $updatedStadium = $this->stadiumRepo->update($fakeStadium, $stadium->id);

        $this->assertModelData($fakeStadium, $updatedStadium->toArray());
        $dbStadium = $this->stadiumRepo->find($stadium->id);
        $this->assertModelData($fakeStadium, $dbStadium->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_stadium()
    {
        $stadium = Stadium::factory()->create();

        $resp = $this->stadiumRepo->delete($stadium->id);

        $this->assertTrue($resp);
        $this->assertNull(Stadium::find($stadium->id), 'Stadium should not exist in DB');
    }
}
