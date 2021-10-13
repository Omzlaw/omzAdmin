<?php namespace Tests\Repositories;

use App\Models\Operator;
use App\Repositories\OperatorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OperatorRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OperatorRepository
     */
    protected $operatorRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->operatorRepo = \App::make(OperatorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_operator()
    {
        $operator = Operator::factory()->make()->toArray();

        $createdOperator = $this->operatorRepo->create($operator);

        $createdOperator = $createdOperator->toArray();
        $this->assertArrayHasKey('id', $createdOperator);
        $this->assertNotNull($createdOperator['id'], 'Created Operator must have id specified');
        $this->assertNotNull(Operator::find($createdOperator['id']), 'Operator with given id must be in DB');
        $this->assertModelData($operator, $createdOperator);
    }

    /**
     * @test read
     */
    public function test_read_operator()
    {
        $operator = Operator::factory()->create();

        $dbOperator = $this->operatorRepo->find($operator->id);

        $dbOperator = $dbOperator->toArray();
        $this->assertModelData($operator->toArray(), $dbOperator);
    }

    /**
     * @test update
     */
    public function test_update_operator()
    {
        $operator = Operator::factory()->create();
        $fakeOperator = Operator::factory()->make()->toArray();

        $updatedOperator = $this->operatorRepo->update($fakeOperator, $operator->id);

        $this->assertModelData($fakeOperator, $updatedOperator->toArray());
        $dbOperator = $this->operatorRepo->find($operator->id);
        $this->assertModelData($fakeOperator, $dbOperator->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_operator()
    {
        $operator = Operator::factory()->create();

        $resp = $this->operatorRepo->delete($operator->id);

        $this->assertTrue($resp);
        $this->assertNull(Operator::find($operator->id), 'Operator should not exist in DB');
    }
}
