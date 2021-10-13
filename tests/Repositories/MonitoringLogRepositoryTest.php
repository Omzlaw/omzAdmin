<?php namespace Tests\Repositories;

use App\Models\MonitoringLog;
use App\Repositories\MonitoringLogRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MonitoringLogRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MonitoringLogRepository
     */
    protected $monitoringLogRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->monitoringLogRepo = \App::make(MonitoringLogRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_monitoring_log()
    {
        $monitoringLog = MonitoringLog::factory()->make()->toArray();

        $createdMonitoringLog = $this->monitoringLogRepo->create($monitoringLog);

        $createdMonitoringLog = $createdMonitoringLog->toArray();
        $this->assertArrayHasKey('id', $createdMonitoringLog);
        $this->assertNotNull($createdMonitoringLog['id'], 'Created MonitoringLog must have id specified');
        $this->assertNotNull(MonitoringLog::find($createdMonitoringLog['id']), 'MonitoringLog with given id must be in DB');
        $this->assertModelData($monitoringLog, $createdMonitoringLog);
    }

    /**
     * @test read
     */
    public function test_read_monitoring_log()
    {
        $monitoringLog = MonitoringLog::factory()->create();

        $dbMonitoringLog = $this->monitoringLogRepo->find($monitoringLog->id);

        $dbMonitoringLog = $dbMonitoringLog->toArray();
        $this->assertModelData($monitoringLog->toArray(), $dbMonitoringLog);
    }

    /**
     * @test update
     */
    public function test_update_monitoring_log()
    {
        $monitoringLog = MonitoringLog::factory()->create();
        $fakeMonitoringLog = MonitoringLog::factory()->make()->toArray();

        $updatedMonitoringLog = $this->monitoringLogRepo->update($fakeMonitoringLog, $monitoringLog->id);

        $this->assertModelData($fakeMonitoringLog, $updatedMonitoringLog->toArray());
        $dbMonitoringLog = $this->monitoringLogRepo->find($monitoringLog->id);
        $this->assertModelData($fakeMonitoringLog, $dbMonitoringLog->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_monitoring_log()
    {
        $monitoringLog = MonitoringLog::factory()->create();

        $resp = $this->monitoringLogRepo->delete($monitoringLog->id);

        $this->assertTrue($resp);
        $this->assertNull(MonitoringLog::find($monitoringLog->id), 'MonitoringLog should not exist in DB');
    }
}
