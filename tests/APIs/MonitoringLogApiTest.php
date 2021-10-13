<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MonitoringLog;

class MonitoringLogApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_monitoring_log()
    {
        $monitoringLog = MonitoringLog::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/monitoring_logs', $monitoringLog
        );

        $this->assertApiResponse($monitoringLog);
    }

    /**
     * @test
     */
    public function test_read_monitoring_log()
    {
        $monitoringLog = MonitoringLog::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/monitoring_logs/'.$monitoringLog->id
        );

        $this->assertApiResponse($monitoringLog->toArray());
    }

    /**
     * @test
     */
    public function test_update_monitoring_log()
    {
        $monitoringLog = MonitoringLog::factory()->create();
        $editedMonitoringLog = MonitoringLog::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/monitoring_logs/'.$monitoringLog->id,
            $editedMonitoringLog
        );

        $this->assertApiResponse($editedMonitoringLog);
    }

    /**
     * @test
     */
    public function test_delete_monitoring_log()
    {
        $monitoringLog = MonitoringLog::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/monitoring_logs/'.$monitoringLog->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/monitoring_logs/'.$monitoringLog->id
        );

        $this->response->assertStatus(404);
    }
}
