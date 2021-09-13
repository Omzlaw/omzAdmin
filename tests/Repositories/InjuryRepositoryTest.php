<?php namespace Tests\Repositories;

use App\Models\Injury;
use App\Repositories\InjuryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class InjuryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var InjuryRepository
     */
    protected $injuryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->injuryRepo = \App::make(InjuryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_injury()
    {
        $injury = Injury::factory()->make()->toArray();

        $createdInjury = $this->injuryRepo->create($injury);

        $createdInjury = $createdInjury->toArray();
        $this->assertArrayHasKey('id', $createdInjury);
        $this->assertNotNull($createdInjury['id'], 'Created Injury must have id specified');
        $this->assertNotNull(Injury::find($createdInjury['id']), 'Injury with given id must be in DB');
        $this->assertModelData($injury, $createdInjury);
    }

    /**
     * @test read
     */
    public function test_read_injury()
    {
        $injury = Injury::factory()->create();

        $dbInjury = $this->injuryRepo->find($injury->id);

        $dbInjury = $dbInjury->toArray();
        $this->assertModelData($injury->toArray(), $dbInjury);
    }

    /**
     * @test update
     */
    public function test_update_injury()
    {
        $injury = Injury::factory()->create();
        $fakeInjury = Injury::factory()->make()->toArray();

        $updatedInjury = $this->injuryRepo->update($fakeInjury, $injury->id);

        $this->assertModelData($fakeInjury, $updatedInjury->toArray());
        $dbInjury = $this->injuryRepo->find($injury->id);
        $this->assertModelData($fakeInjury, $dbInjury->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_injury()
    {
        $injury = Injury::factory()->create();

        $resp = $this->injuryRepo->delete($injury->id);

        $this->assertTrue($resp);
        $this->assertNull(Injury::find($injury->id), 'Injury should not exist in DB');
    }
}
