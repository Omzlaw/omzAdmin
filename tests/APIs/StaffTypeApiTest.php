<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StaffType;

class StaffTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_staff_type()
    {
        $staffType = StaffType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/staff_types', $staffType
        );

        $this->assertApiResponse($staffType);
    }

    /**
     * @test
     */
    public function test_read_staff_type()
    {
        $staffType = StaffType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/staff_types/'.$staffType->id
        );

        $this->assertApiResponse($staffType->toArray());
    }

    /**
     * @test
     */
    public function test_update_staff_type()
    {
        $staffType = StaffType::factory()->create();
        $editedStaffType = StaffType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/staff_types/'.$staffType->id,
            $editedStaffType
        );

        $this->assertApiResponse($editedStaffType);
    }

    /**
     * @test
     */
    public function test_delete_staff_type()
    {
        $staffType = StaffType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/staff_types/'.$staffType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/staff_types/'.$staffType->id
        );

        $this->response->assertStatus(404);
    }
}
