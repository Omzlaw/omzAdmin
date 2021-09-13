<?php namespace Tests\Repositories;

use App\Models\Formation;
use App\Repositories\FormationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class FormationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var FormationRepository
     */
    protected $formationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->formationRepo = \App::make(FormationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_formation()
    {
        $formation = Formation::factory()->make()->toArray();

        $createdFormation = $this->formationRepo->create($formation);

        $createdFormation = $createdFormation->toArray();
        $this->assertArrayHasKey('id', $createdFormation);
        $this->assertNotNull($createdFormation['id'], 'Created Formation must have id specified');
        $this->assertNotNull(Formation::find($createdFormation['id']), 'Formation with given id must be in DB');
        $this->assertModelData($formation, $createdFormation);
    }

    /**
     * @test read
     */
    public function test_read_formation()
    {
        $formation = Formation::factory()->create();

        $dbFormation = $this->formationRepo->find($formation->id);

        $dbFormation = $dbFormation->toArray();
        $this->assertModelData($formation->toArray(), $dbFormation);
    }

    /**
     * @test update
     */
    public function test_update_formation()
    {
        $formation = Formation::factory()->create();
        $fakeFormation = Formation::factory()->make()->toArray();

        $updatedFormation = $this->formationRepo->update($fakeFormation, $formation->id);

        $this->assertModelData($fakeFormation, $updatedFormation->toArray());
        $dbFormation = $this->formationRepo->find($formation->id);
        $this->assertModelData($fakeFormation, $dbFormation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_formation()
    {
        $formation = Formation::factory()->create();

        $resp = $this->formationRepo->delete($formation->id);

        $this->assertTrue($resp);
        $this->assertNull(Formation::find($formation->id), 'Formation should not exist in DB');
    }
}
