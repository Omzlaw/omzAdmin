<?php namespace Tests\Repositories;

use App\Models\ActivityLog;
use App\Repositories\ActivityLogRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ActivityLogRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ActivityLogRepository
     */
    protected $activityLogRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->activityLogRepo = \App::make(ActivityLogRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_activity_log()
    {
        $activityLog = ActivityLog::factory()->make()->toArray();

        $createdActivityLog = $this->activityLogRepo->create($activityLog);

        $createdActivityLog = $createdActivityLog->toArray();
        $this->assertArrayHasKey('id', $createdActivityLog);
        $this->assertNotNull($createdActivityLog['id'], 'Created ActivityLog must have id specified');
        $this->assertNotNull(ActivityLog::find($createdActivityLog['id']), 'ActivityLog with given id must be in DB');
        $this->assertModelData($activityLog, $createdActivityLog);
    }

    /**
     * @test read
     */
    public function test_read_activity_log()
    {
        $activityLog = ActivityLog::factory()->create();

        $dbActivityLog = $this->activityLogRepo->find($activityLog->id);

        $dbActivityLog = $dbActivityLog->toArray();
        $this->assertModelData($activityLog->toArray(), $dbActivityLog);
    }

    /**
     * @test update
     */
    public function test_update_activity_log()
    {
        $activityLog = ActivityLog::factory()->create();
        $fakeActivityLog = ActivityLog::factory()->make()->toArray();

        $updatedActivityLog = $this->activityLogRepo->update($fakeActivityLog, $activityLog->id);

        $this->assertModelData($fakeActivityLog, $updatedActivityLog->toArray());
        $dbActivityLog = $this->activityLogRepo->find($activityLog->id);
        $this->assertModelData($fakeActivityLog, $dbActivityLog->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_activity_log()
    {
        $activityLog = ActivityLog::factory()->create();

        $resp = $this->activityLogRepo->delete($activityLog->id);

        $this->assertTrue($resp);
        $this->assertNull(ActivityLog::find($activityLog->id), 'ActivityLog should not exist in DB');
    }
}
