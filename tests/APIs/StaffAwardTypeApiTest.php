<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StaffAwardType;

class StaffAwardTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_staff_award_type()
    {
        $staffAwardType = StaffAwardType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/staff_award_types', $staffAwardType
        );

        $this->assertApiResponse($staffAwardType);
    }

    /**
     * @test
     */
    public function test_read_staff_award_type()
    {
        $staffAwardType = StaffAwardType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/staff_award_types/'.$staffAwardType->id
        );

        $this->assertApiResponse($staffAwardType->toArray());
    }

    /**
     * @test
     */
    public function test_update_staff_award_type()
    {
        $staffAwardType = StaffAwardType::factory()->create();
        $editedStaffAwardType = StaffAwardType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/staff_award_types/'.$staffAwardType->id,
            $editedStaffAwardType
        );

        $this->assertApiResponse($editedStaffAwardType);
    }

    /**
     * @test
     */
    public function test_delete_staff_award_type()
    {
        $staffAwardType = StaffAwardType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/staff_award_types/'.$staffAwardType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/staff_award_types/'.$staffAwardType->id
        );

        $this->response->assertStatus(404);
    }
}
