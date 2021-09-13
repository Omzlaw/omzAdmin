<?php namespace Tests\Repositories;

use App\Models\SquadStaff;
use App\Repositories\SquadStaffRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SquadStaffRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SquadStaffRepository
     */
    protected $squadStaffRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->squadStaffRepo = \App::make(SquadStaffRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_squad_staff()
    {
        $squadStaff = SquadStaff::factory()->make()->toArray();

        $createdSquadStaff = $this->squadStaffRepo->create($squadStaff);

        $createdSquadStaff = $createdSquadStaff->toArray();
        $this->assertArrayHasKey('id', $createdSquadStaff);
        $this->assertNotNull($createdSquadStaff['id'], 'Created SquadStaff must have id specified');
        $this->assertNotNull(SquadStaff::find($createdSquadStaff['id']), 'SquadStaff with given id must be in DB');
        $this->assertModelData($squadStaff, $createdSquadStaff);
    }

    /**
     * @test read
     */
    public function test_read_squad_staff()
    {
        $squadStaff = SquadStaff::factory()->create();

        $dbSquadStaff = $this->squadStaffRepo->find($squadStaff->id);

        $dbSquadStaff = $dbSquadStaff->toArray();
        $this->assertModelData($squadStaff->toArray(), $dbSquadStaff);
    }

    /**
     * @test update
     */
    public function test_update_squad_staff()
    {
        $squadStaff = SquadStaff::factory()->create();
        $fakeSquadStaff = SquadStaff::factory()->make()->toArray();

        $updatedSquadStaff = $this->squadStaffRepo->update($fakeSquadStaff, $squadStaff->id);

        $this->assertModelData($fakeSquadStaff, $updatedSquadStaff->toArray());
        $dbSquadStaff = $this->squadStaffRepo->find($squadStaff->id);
        $this->assertModelData($fakeSquadStaff, $dbSquadStaff->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_squad_staff()
    {
        $squadStaff = SquadStaff::factory()->create();

        $resp = $this->squadStaffRepo->delete($squadStaff->id);

        $this->assertTrue($resp);
        $this->assertNull(SquadStaff::find($squadStaff->id), 'SquadStaff should not exist in DB');
    }
}
