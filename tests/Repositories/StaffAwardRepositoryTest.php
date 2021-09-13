<?php namespace Tests\Repositories;

use App\Models\StaffAward;
use App\Repositories\StaffAwardRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StaffAwardRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StaffAwardRepository
     */
    protected $staffAwardRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->staffAwardRepo = \App::make(StaffAwardRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_staff_award()
    {
        $staffAward = StaffAward::factory()->make()->toArray();

        $createdStaffAward = $this->staffAwardRepo->create($staffAward);

        $createdStaffAward = $createdStaffAward->toArray();
        $this->assertArrayHasKey('id', $createdStaffAward);
        $this->assertNotNull($createdStaffAward['id'], 'Created StaffAward must have id specified');
        $this->assertNotNull(StaffAward::find($createdStaffAward['id']), 'StaffAward with given id must be in DB');
        $this->assertModelData($staffAward, $createdStaffAward);
    }

    /**
     * @test read
     */
    public function test_read_staff_award()
    {
        $staffAward = StaffAward::factory()->create();

        $dbStaffAward = $this->staffAwardRepo->find($staffAward->id);

        $dbStaffAward = $dbStaffAward->toArray();
        $this->assertModelData($staffAward->toArray(), $dbStaffAward);
    }

    /**
     * @test update
     */
    public function test_update_staff_award()
    {
        $staffAward = StaffAward::factory()->create();
        $fakeStaffAward = StaffAward::factory()->make()->toArray();

        $updatedStaffAward = $this->staffAwardRepo->update($fakeStaffAward, $staffAward->id);

        $this->assertModelData($fakeStaffAward, $updatedStaffAward->toArray());
        $dbStaffAward = $this->staffAwardRepo->find($staffAward->id);
        $this->assertModelData($fakeStaffAward, $dbStaffAward->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_staff_award()
    {
        $staffAward = StaffAward::factory()->create();

        $resp = $this->staffAwardRepo->delete($staffAward->id);

        $this->assertTrue($resp);
        $this->assertNull(StaffAward::find($staffAward->id), 'StaffAward should not exist in DB');
    }
}
