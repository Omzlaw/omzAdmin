<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OperatorLicense;

class OperatorLicenseApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_operator_license()
    {
        $operatorLicense = OperatorLicense::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/operator_licenses', $operatorLicense
        );

        $this->assertApiResponse($operatorLicense);
    }

    /**
     * @test
     */
    public function test_read_operator_license()
    {
        $operatorLicense = OperatorLicense::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/operator_licenses/'.$operatorLicense->id
        );

        $this->assertApiResponse($operatorLicense->toArray());
    }

    /**
     * @test
     */
    public function test_update_operator_license()
    {
        $operatorLicense = OperatorLicense::factory()->create();
        $editedOperatorLicense = OperatorLicense::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/operator_licenses/'.$operatorLicense->id,
            $editedOperatorLicense
        );

        $this->assertApiResponse($editedOperatorLicense);
    }

    /**
     * @test
     */
    public function test_delete_operator_license()
    {
        $operatorLicense = OperatorLicense::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/operator_licenses/'.$operatorLicense->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/operator_licenses/'.$operatorLicense->id
        );

        $this->response->assertStatus(404);
    }
}
