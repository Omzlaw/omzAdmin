<?php namespace Tests\Repositories;

use App\Models\StaffType;
use App\Repositories\StaffTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StaffTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StaffTypeRepository
     */
    protected $staffTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->staffTypeRepo = \App::make(StaffTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_staff_type()
    {
        $staffType = StaffType::factory()->make()->toArray();

        $createdStaffType = $this->staffTypeRepo->create($staffType);

        $createdStaffType = $createdStaffType->toArray();
        $this->assertArrayHasKey('id', $createdStaffType);
        $this->assertNotNull($createdStaffType['id'], 'Created StaffType must have id specified');
        $this->assertNotNull(StaffType::find($createdStaffType['id']), 'StaffType with given id must be in DB');
        $this->assertModelData($staffType, $createdStaffType);
    }

    /**
     * @test read
     */
    public function test_read_staff_type()
    {
        $staffType = StaffType::factory()->create();

        $dbStaffType = $this->staffTypeRepo->find($staffType->id);

        $dbStaffType = $dbStaffType->toArray();
        $this->assertModelData($staffType->toArray(), $dbStaffType);
    }

    /**
     * @test update
     */
    public function test_update_staff_type()
    {
        $staffType = StaffType::factory()->create();
        $fakeStaffType = StaffType::factory()->make()->toArray();

        $updatedStaffType = $this->staffTypeRepo->update($fakeStaffType, $staffType->id);

        $this->assertModelData($fakeStaffType, $updatedStaffType->toArray());
        $dbStaffType = $this->staffTypeRepo->find($staffType->id);
        $this->assertModelData($fakeStaffType, $dbStaffType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_staff_type()
    {
        $staffType = StaffType::factory()->create();

        $resp = $this->staffTypeRepo->delete($staffType->id);

        $this->assertTrue($resp);
        $this->assertNull(StaffType::find($staffType->id), 'StaffType should not exist in DB');
    }
}
