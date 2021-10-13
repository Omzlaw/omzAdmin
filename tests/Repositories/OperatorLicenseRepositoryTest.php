<?php namespace Tests\Repositories;

use App\Models\OperatorLicense;
use App\Repositories\OperatorLicenseRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OperatorLicenseRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OperatorLicenseRepository
     */
    protected $operatorLicenseRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->operatorLicenseRepo = \App::make(OperatorLicenseRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_operator_license()
    {
        $operatorLicense = OperatorLicense::factory()->make()->toArray();

        $createdOperatorLicense = $this->operatorLicenseRepo->create($operatorLicense);

        $createdOperatorLicense = $createdOperatorLicense->toArray();
        $this->assertArrayHasKey('id', $createdOperatorLicense);
        $this->assertNotNull($createdOperatorLicense['id'], 'Created OperatorLicense must have id specified');
        $this->assertNotNull(OperatorLicense::find($createdOperatorLicense['id']), 'OperatorLicense with given id must be in DB');
        $this->assertModelData($operatorLicense, $createdOperatorLicense);
    }

    /**
     * @test read
     */
    public function test_read_operator_license()
    {
        $operatorLicense = OperatorLicense::factory()->create();

        $dbOperatorLicense = $this->operatorLicenseRepo->find($operatorLicense->id);

        $dbOperatorLicense = $dbOperatorLicense->toArray();
        $this->assertModelData($operatorLicense->toArray(), $dbOperatorLicense);
    }

    /**
     * @test update
     */
    public function test_update_operator_license()
    {
        $operatorLicense = OperatorLicense::factory()->create();
        $fakeOperatorLicense = OperatorLicense::factory()->make()->toArray();

        $updatedOperatorLicense = $this->operatorLicenseRepo->update($fakeOperatorLicense, $operatorLicense->id);

        $this->assertModelData($fakeOperatorLicense, $updatedOperatorLicense->toArray());
        $dbOperatorLicense = $this->operatorLicenseRepo->find($operatorLicense->id);
        $this->assertModelData($fakeOperatorLicense, $dbOperatorLicense->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_operator_license()
    {
        $operatorLicense = OperatorLicense::factory()->create();

        $resp = $this->operatorLicenseRepo->delete($operatorLicense->id);

        $this->assertTrue($resp);
        $this->assertNull(OperatorLicense::find($operatorLicense->id), 'OperatorLicense should not exist in DB');
    }
}
