<?php namespace Tests\Repositories;

use App\Models\OperatorType;
use App\Repositories\OperatorTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OperatorTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OperatorTypeRepository
     */
    protected $operatorTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->operatorTypeRepo = \App::make(OperatorTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_operator_type()
    {
        $operatorType = OperatorType::factory()->make()->toArray();

        $createdOperatorType = $this->operatorTypeRepo->create($operatorType);

        $createdOperatorType = $createdOperatorType->toArray();
        $this->assertArrayHasKey('id', $createdOperatorType);
        $this->assertNotNull($createdOperatorType['id'], 'Created OperatorType must have id specified');
        $this->assertNotNull(OperatorType::find($createdOperatorType['id']), 'OperatorType with given id must be in DB');
        $this->assertModelData($operatorType, $createdOperatorType);
    }

    /**
     * @test read
     */
    public function test_read_operator_type()
    {
        $operatorType = OperatorType::factory()->create();

        $dbOperatorType = $this->operatorTypeRepo->find($operatorType->id);

        $dbOperatorType = $dbOperatorType->toArray();
        $this->assertModelData($operatorType->toArray(), $dbOperatorType);
    }

    /**
     * @test update
     */
    public function test_update_operator_type()
    {
        $operatorType = OperatorType::factory()->create();
        $fakeOperatorType = OperatorType::factory()->make()->toArray();

        $updatedOperatorType = $this->operatorTypeRepo->update($fakeOperatorType, $operatorType->id);

        $this->assertModelData($fakeOperatorType, $updatedOperatorType->toArray());
        $dbOperatorType = $this->operatorTypeRepo->find($operatorType->id);
        $this->assertModelData($fakeOperatorType, $dbOperatorType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_operator_type()
    {
        $operatorType = OperatorType::factory()->create();

        $resp = $this->operatorTypeRepo->delete($operatorType->id);

        $this->assertTrue($resp);
        $this->assertNull(OperatorType::find($operatorType->id), 'OperatorType should not exist in DB');
    }
}
