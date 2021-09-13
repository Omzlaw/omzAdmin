<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StaffAward;

class StaffAwardApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_staff_award()
    {
        $staffAward = StaffAward::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/staff_awards', $staffAward
        );

        $this->assertApiResponse($staffAward);
    }

    /**
     * @test
     */
    public function test_read_staff_award()
    {
        $staffAward = StaffAward::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/staff_awards/'.$staffAward->id
        );

        $this->assertApiResponse($staffAward->toArray());
    }

    /**
     * @test
     */
    public function test_update_staff_award()
    {
        $staffAward = StaffAward::factory()->create();
        $editedStaffAward = StaffAward::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/staff_awards/'.$staffAward->id,
            $editedStaffAward
        );

        $this->assertApiResponse($editedStaffAward);
    }

    /**
     * @test
     */
    public function test_delete_staff_award()
    {
        $staffAward = StaffAward::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/staff_awards/'.$staffAward->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/staff_awards/'.$staffAward->id
        );

        $this->response->assertStatus(404);
    }
}
