<?php namespace Tests\Repositories;

use App\Models\LicenseType;
use App\Repositories\LicenseTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LicenseTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LicenseTypeRepository
     */
    protected $licenseTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->licenseTypeRepo = \App::make(LicenseTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_license_type()
    {
        $licenseType = LicenseType::factory()->make()->toArray();

        $createdLicenseType = $this->licenseTypeRepo->create($licenseType);

        $createdLicenseType = $createdLicenseType->toArray();
        $this->assertArrayHasKey('id', $createdLicenseType);
        $this->assertNotNull($createdLicenseType['id'], 'Created LicenseType must have id specified');
        $this->assertNotNull(LicenseType::find($createdLicenseType['id']), 'LicenseType with given id must be in DB');
        $this->assertModelData($licenseType, $createdLicenseType);
    }

    /**
     * @test read
     */
    public function test_read_license_type()
    {
        $licenseType = LicenseType::factory()->create();

        $dbLicenseType = $this->licenseTypeRepo->find($licenseType->id);

        $dbLicenseType = $dbLicenseType->toArray();
        $this->assertModelData($licenseType->toArray(), $dbLicenseType);
    }

    /**
     * @test update
     */
    public function test_update_license_type()
    {
        $licenseType = LicenseType::factory()->create();
        $fakeLicenseType = LicenseType::factory()->make()->toArray();

        $updatedLicenseType = $this->licenseTypeRepo->update($fakeLicenseType, $licenseType->id);

        $this->assertModelData($fakeLicenseType, $updatedLicenseType->toArray());
        $dbLicenseType = $this->licenseTypeRepo->find($licenseType->id);
        $this->assertModelData($fakeLicenseType, $dbLicenseType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_license_type()
    {
        $licenseType = LicenseType::factory()->create();

        $resp = $this->licenseTypeRepo->delete($licenseType->id);

        $this->assertTrue($resp);
        $this->assertNull(LicenseType::find($licenseType->id), 'LicenseType should not exist in DB');
    }
}
