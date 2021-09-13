<?php namespace Tests\Repositories;

use App\Models\Referee;
use App\Repositories\RefereeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RefereeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RefereeRepository
     */
    protected $refereeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->refereeRepo = \App::make(RefereeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_referee()
    {
        $referee = Referee::factory()->make()->toArray();

        $createdReferee = $this->refereeRepo->create($referee);

        $createdReferee = $createdReferee->toArray();
        $this->assertArrayHasKey('id', $createdReferee);
        $this->assertNotNull($createdReferee['id'], 'Created Referee must have id specified');
        $this->assertNotNull(Referee::find($createdReferee['id']), 'Referee with given id must be in DB');
        $this->assertModelData($referee, $createdReferee);
    }

    /**
     * @test read
     */
    public function test_read_referee()
    {
        $referee = Referee::factory()->create();

        $dbReferee = $this->refereeRepo->find($referee->id);

        $dbReferee = $dbReferee->toArray();
        $this->assertModelData($referee->toArray(), $dbReferee);
    }

    /**
     * @test update
     */
    public function test_update_referee()
    {
        $referee = Referee::factory()->create();
        $fakeReferee = Referee::factory()->make()->toArray();

        $updatedReferee = $this->refereeRepo->update($fakeReferee, $referee->id);

        $this->assertModelData($fakeReferee, $updatedReferee->toArray());
        $dbReferee = $this->refereeRepo->find($referee->id);
        $this->assertModelData($fakeReferee, $dbReferee->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_referee()
    {
        $referee = Referee::factory()->create();

        $resp = $this->refereeRepo->delete($referee->id);

        $this->assertTrue($resp);
        $this->assertNull(Referee::find($referee->id), 'Referee should not exist in DB');
    }
}
