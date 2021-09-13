<?php namespace Tests\Repositories;

use App\Models\InjuryType;
use App\Repositories\InjuryTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class InjuryTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var InjuryTypeRepository
     */
    protected $injuryTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->injuryTypeRepo = \App::make(InjuryTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_injury_type()
    {
        $injuryType = InjuryType::factory()->make()->toArray();

        $createdInjuryType = $this->injuryTypeRepo->create($injuryType);

        $createdInjuryType = $createdInjuryType->toArray();
        $this->assertArrayHasKey('id', $createdInjuryType);
        $this->assertNotNull($createdInjuryType['id'], 'Created InjuryType must have id specified');
        $this->assertNotNull(InjuryType::find($createdInjuryType['id']), 'InjuryType with given id must be in DB');
        $this->assertModelData($injuryType, $createdInjuryType);
    }

    /**
     * @test read
     */
    public function test_read_injury_type()
    {
        $injuryType = InjuryType::factory()->create();

        $dbInjuryType = $this->injuryTypeRepo->find($injuryType->id);

        $dbInjuryType = $dbInjuryType->toArray();
        $this->assertModelData($injuryType->toArray(), $dbInjuryType);
    }

    /**
     * @test update
     */
    public function test_update_injury_type()
    {
        $injuryType = InjuryType::factory()->create();
        $fakeInjuryType = InjuryType::factory()->make()->toArray();

        $updatedInjuryType = $this->injuryTypeRepo->update($fakeInjuryType, $injuryType->id);

        $this->assertModelData($fakeInjuryType, $updatedInjuryType->toArray());
        $dbInjuryType = $this->injuryTypeRepo->find($injuryType->id);
        $this->assertModelData($fakeInjuryType, $dbInjuryType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_injury_type()
    {
        $injuryType = InjuryType::factory()->create();

        $resp = $this->injuryTypeRepo->delete($injuryType->id);

        $this->assertTrue($resp);
        $this->assertNull(InjuryType::find($injuryType->id), 'InjuryType should not exist in DB');
    }
}
