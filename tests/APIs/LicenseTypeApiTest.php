<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\LicenseType;

class LicenseTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_license_type()
    {
        $licenseType = LicenseType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/license_types', $licenseType
        );

        $this->assertApiResponse($licenseType);
    }

    /**
     * @test
     */
    public function test_read_license_type()
    {
        $licenseType = LicenseType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/license_types/'.$licenseType->id
        );

        $this->assertApiResponse($licenseType->toArray());
    }

    /**
     * @test
     */
    public function test_update_license_type()
    {
        $licenseType = LicenseType::factory()->create();
        $editedLicenseType = LicenseType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/license_types/'.$licenseType->id,
            $editedLicenseType
        );

        $this->assertApiResponse($editedLicenseType);
    }

    /**
     * @test
     */
    public function test_delete_license_type()
    {
        $licenseType = LicenseType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/license_types/'.$licenseType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/license_types/'.$licenseType->id
        );

        $this->response->assertStatus(404);
    }
}
