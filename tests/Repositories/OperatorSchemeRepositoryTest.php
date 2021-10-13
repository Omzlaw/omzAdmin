<?php namespace Tests\Repositories;

use App\Models\OperatorScheme;
use App\Repositories\OperatorSchemeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OperatorSchemeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OperatorSchemeRepository
     */
    protected $operatorSchemeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->operatorSchemeRepo = \App::make(OperatorSchemeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_operator_scheme()
    {
        $operatorScheme = OperatorScheme::factory()->make()->toArray();

        $createdOperatorScheme = $this->operatorSchemeRepo->create($operatorScheme);

        $createdOperatorScheme = $createdOperatorScheme->toArray();
        $this->assertArrayHasKey('id', $createdOperatorScheme);
        $this->assertNotNull($createdOperatorScheme['id'], 'Created OperatorScheme must have id specified');
        $this->assertNotNull(OperatorScheme::find($createdOperatorScheme['id']), 'OperatorScheme with given id must be in DB');
        $this->assertModelData($operatorScheme, $createdOperatorScheme);
    }

    /**
     * @test read
     */
    public function test_read_operator_scheme()
    {
        $operatorScheme = OperatorScheme::factory()->create();

        $dbOperatorScheme = $this->operatorSchemeRepo->find($operatorScheme->id);

        $dbOperatorScheme = $dbOperatorScheme->toArray();
        $this->assertModelData($operatorScheme->toArray(), $dbOperatorScheme);
    }

    /**
     * @test update
     */
    public function test_update_operator_scheme()
    {
        $operatorScheme = OperatorScheme::factory()->create();
        $fakeOperatorScheme = OperatorScheme::factory()->make()->toArray();

        $updatedOperatorScheme = $this->operatorSchemeRepo->update($fakeOperatorScheme, $operatorScheme->id);

        $this->assertModelData($fakeOperatorScheme, $updatedOperatorScheme->toArray());
        $dbOperatorScheme = $this->operatorSchemeRepo->find($operatorScheme->id);
        $this->assertModelData($fakeOperatorScheme, $dbOperatorScheme->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_operator_scheme()
    {
        $operatorScheme = OperatorScheme::factory()->create();

        $resp = $this->operatorSchemeRepo->delete($operatorScheme->id);

        $this->assertTrue($resp);
        $this->assertNull(OperatorScheme::find($operatorScheme->id), 'OperatorScheme should not exist in DB');
    }
}
