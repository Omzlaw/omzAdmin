<?php namespace Tests\Repositories;

use App\Models\LicenseChecklist;
use App\Repositories\LicenseChecklistRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LicenseChecklistRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LicenseChecklistRepository
     */
    protected $licenseChecklistRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->licenseChecklistRepo = \App::make(LicenseChecklistRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_license_checklist()
    {
        $licenseChecklist = LicenseChecklist::factory()->make()->toArray();

        $createdLicenseChecklist = $this->licenseChecklistRepo->create($licenseChecklist);

        $createdLicenseChecklist = $createdLicenseChecklist->toArray();
        $this->assertArrayHasKey('id', $createdLicenseChecklist);
        $this->assertNotNull($createdLicenseChecklist['id'], 'Created LicenseChecklist must have id specified');
        $this->assertNotNull(LicenseChecklist::find($createdLicenseChecklist['id']), 'LicenseChecklist with given id must be in DB');
        $this->assertModelData($licenseChecklist, $createdLicenseChecklist);
    }

    /**
     * @test read
     */
    public function test_read_license_checklist()
    {
        $licenseChecklist = LicenseChecklist::factory()->create();

        $dbLicenseChecklist = $this->licenseChecklistRepo->find($licenseChecklist->id);

        $dbLicenseChecklist = $dbLicenseChecklist->toArray();
        $this->assertModelData($licenseChecklist->toArray(), $dbLicenseChecklist);
    }

    /**
     * @test update
     */
    public function test_update_license_checklist()
    {
        $licenseChecklist = LicenseChecklist::factory()->create();
        $fakeLicenseChecklist = LicenseChecklist::factory()->make()->toArray();

        $updatedLicenseChecklist = $this->licenseChecklistRepo->update($fakeLicenseChecklist, $licenseChecklist->id);

        $this->assertModelData($fakeLicenseChecklist, $updatedLicenseChecklist->toArray());
        $dbLicenseChecklist = $this->licenseChecklistRepo->find($licenseChecklist->id);
        $this->assertModelData($fakeLicenseChecklist, $dbLicenseChecklist->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_license_checklist()
    {
        $licenseChecklist = LicenseChecklist::factory()->create();

        $resp = $this->licenseChecklistRepo->delete($licenseChecklist->id);

        $this->assertTrue($resp);
        $this->assertNull(LicenseChecklist::find($licenseChecklist->id), 'LicenseChecklist should not exist in DB');
    }
}
