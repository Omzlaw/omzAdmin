<?php namespace Tests\Repositories;

use App\Models\JerseySet;
use App\Repositories\JerseySetRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class JerseySetRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var JerseySetRepository
     */
    protected $jerseySetRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->jerseySetRepo = \App::make(JerseySetRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_jersey_set()
    {
        $jerseySet = JerseySet::factory()->make()->toArray();

        $createdJerseySet = $this->jerseySetRepo->create($jerseySet);

        $createdJerseySet = $createdJerseySet->toArray();
        $this->assertArrayHasKey('id', $createdJerseySet);
        $this->assertNotNull($createdJerseySet['id'], 'Created JerseySet must have id specified');
        $this->assertNotNull(JerseySet::find($createdJerseySet['id']), 'JerseySet with given id must be in DB');
        $this->assertModelData($jerseySet, $createdJerseySet);
    }

    /**
     * @test read
     */
    public function test_read_jersey_set()
    {
        $jerseySet = JerseySet::factory()->create();

        $dbJerseySet = $this->jerseySetRepo->find($jerseySet->id);

        $dbJerseySet = $dbJerseySet->toArray();
        $this->assertModelData($jerseySet->toArray(), $dbJerseySet);
    }

    /**
     * @test update
     */
    public function test_update_jersey_set()
    {
        $jerseySet = JerseySet::factory()->create();
        $fakeJerseySet = JerseySet::factory()->make()->toArray();

        $updatedJerseySet = $this->jerseySetRepo->update($fakeJerseySet, $jerseySet->id);

        $this->assertModelData($fakeJerseySet, $updatedJerseySet->toArray());
        $dbJerseySet = $this->jerseySetRepo->find($jerseySet->id);
        $this->assertModelData($fakeJerseySet, $dbJerseySet->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_jersey_set()
    {
        $jerseySet = JerseySet::factory()->create();

        $resp = $this->jerseySetRepo->delete($jerseySet->id);

        $this->assertTrue($resp);
        $this->assertNull(JerseySet::find($jerseySet->id), 'JerseySet should not exist in DB');
    }
}
