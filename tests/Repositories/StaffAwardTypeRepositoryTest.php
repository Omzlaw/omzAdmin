<?php namespace Tests\Repositories;

use App\Models\StaffAwardType;
use App\Repositories\StaffAwardTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StaffAwardTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StaffAwardTypeRepository
     */
    protected $staffAwardTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->staffAwardTypeRepo = \App::make(StaffAwardTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_staff_award_type()
    {
        $staffAwardType = StaffAwardType::factory()->make()->toArray();

        $createdStaffAwardType = $this->staffAwardTypeRepo->create($staffAwardType);

        $createdStaffAwardType = $createdStaffAwardType->toArray();
        $this->assertArrayHasKey('id', $createdStaffAwardType);
        $this->assertNotNull($createdStaffAwardType['id'], 'Created StaffAwardType must have id specified');
        $this->assertNotNull(StaffAwardType::find($createdStaffAwardType['id']), 'StaffAwardType with given id must be in DB');
        $this->assertModelData($staffAwardType, $createdStaffAwardType);
    }

    /**
     * @test read
     */
    public function test_read_staff_award_type()
    {
        $staffAwardType = StaffAwardType::factory()->create();

        $dbStaffAwardType = $this->staffAwardTypeRepo->find($staffAwardType->id);

        $dbStaffAwardType = $dbStaffAwardType->toArray();
        $this->assertModelData($staffAwardType->toArray(), $dbStaffAwardType);
    }

    /**
     * @test update
     */
    public function test_update_staff_award_type()
    {
        $staffAwardType = StaffAwardType::factory()->create();
        $fakeStaffAwardType = StaffAwardType::factory()->make()->toArray();

        $updatedStaffAwardType = $this->staffAwardTypeRepo->update($fakeStaffAwardType, $staffAwardType->id);

        $this->assertModelData($fakeStaffAwardType, $updatedStaffAwardType->toArray());
        $dbStaffAwardType = $this->staffAwardTypeRepo->find($staffAwardType->id);
        $this->assertModelData($fakeStaffAwardType, $dbStaffAwardType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_staff_award_type()
    {
        $staffAwardType = StaffAwardType::factory()->create();

        $resp = $this->staffAwardTypeRepo->delete($staffAwardType->id);

        $this->assertTrue($resp);
        $this->assertNull(StaffAwardType::find($staffAwardType->id), 'StaffAwardType should not exist in DB');
    }
}
