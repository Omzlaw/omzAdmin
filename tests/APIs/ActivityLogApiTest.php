<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ActivityLog;

class ActivityLogApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_activity_log()
    {
        $activityLog = ActivityLog::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/activity_logs', $activityLog
        );

        $this->assertApiResponse($activityLog);
    }

    /**
     * @test
     */
    public function test_read_activity_log()
    {
        $activityLog = ActivityLog::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/activity_logs/'.$activityLog->id
        );

        $this->assertApiResponse($activityLog->toArray());
    }

    /**
     * @test
     */
    public function test_update_activity_log()
    {
        $activityLog = ActivityLog::factory()->create();
        $editedActivityLog = ActivityLog::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/activity_logs/'.$activityLog->id,
            $editedActivityLog
        );

        $this->assertApiResponse($editedActivityLog);
    }

    /**
     * @test
     */
    public function test_delete_activity_log()
    {
        $activityLog = ActivityLog::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/activity_logs/'.$activityLog->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/activity_logs/'.$activityLog->id
        );

        $this->response->assertStatus(404);
    }
}
