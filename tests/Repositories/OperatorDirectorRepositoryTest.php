<?php namespace Tests\Repositories;

use App\Models\OperatorDirector;
use App\Repositories\OperatorDirectorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OperatorDirectorRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OperatorDirectorRepository
     */
    protected $operatorDirectorRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->operatorDirectorRepo = \App::make(OperatorDirectorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_operator_director()
    {
        $operatorDirector = OperatorDirector::factory()->make()->toArray();

        $createdOperatorDirector = $this->operatorDirectorRepo->create($operatorDirector);

        $createdOperatorDirector = $createdOperatorDirector->toArray();
        $this->assertArrayHasKey('id', $createdOperatorDirector);
        $this->assertNotNull($createdOperatorDirector['id'], 'Created OperatorDirector must have id specified');
        $this->assertNotNull(OperatorDirector::find($createdOperatorDirector['id']), 'OperatorDirector with given id must be in DB');
        $this->assertModelData($operatorDirector, $createdOperatorDirector);
    }

    /**
     * @test read
     */
    public function test_read_operator_director()
    {
        $operatorDirector = OperatorDirector::factory()->create();

        $dbOperatorDirector = $this->operatorDirectorRepo->find($operatorDirector->id);

        $dbOperatorDirector = $dbOperatorDirector->toArray();
        $this->assertModelData($operatorDirector->toArray(), $dbOperatorDirector);
    }

    /**
     * @test update
     */
    public function test_update_operator_director()
    {
        $operatorDirector = OperatorDirector::factory()->create();
        $fakeOperatorDirector = OperatorDirector::factory()->make()->toArray();

        $updatedOperatorDirector = $this->operatorDirectorRepo->update($fakeOperatorDirector, $operatorDirector->id);

        $this->assertModelData($fakeOperatorDirector, $updatedOperatorDirector->toArray());
        $dbOperatorDirector = $this->operatorDirectorRepo->find($operatorDirector->id);
        $this->assertModelData($fakeOperatorDirector, $dbOperatorDirector->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_operator_director()
    {
        $operatorDirector = OperatorDirector::factory()->create();

        $resp = $this->operatorDirectorRepo->delete($operatorDirector->id);

        $this->assertTrue($resp);
        $this->assertNull(OperatorDirector::find($operatorDirector->id), 'OperatorDirector should not exist in DB');
    }
}
