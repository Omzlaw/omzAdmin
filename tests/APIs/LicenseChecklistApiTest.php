<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\LicenseChecklist;

class LicenseChecklistApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_license_checklist()
    {
        $licenseChecklist = LicenseChecklist::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/license_checklists', $licenseChecklist
        );

        $this->assertApiResponse($licenseChecklist);
    }

    /**
     * @test
     */
    public function test_read_license_checklist()
    {
        $licenseChecklist = LicenseChecklist::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/license_checklists/'.$licenseChecklist->id
        );

        $this->assertApiResponse($licenseChecklist->toArray());
    }

    /**
     * @test
     */
    public function test_update_license_checklist()
    {
        $licenseChecklist = LicenseChecklist::factory()->create();
        $editedLicenseChecklist = LicenseChecklist::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/license_checklists/'.$licenseChecklist->id,
            $editedLicenseChecklist
        );

        $this->assertApiResponse($editedLicenseChecklist);
    }

    /**
     * @test
     */
    public function test_delete_license_checklist()
    {
        $licenseChecklist = LicenseChecklist::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/license_checklists/'.$licenseChecklist->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/license_checklists/'.$licenseChecklist->id
        );

        $this->response->assertStatus(404);
    }
}
