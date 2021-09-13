<?php namespace Tests\Repositories;

use App\Models\TransferType;
use App\Repositories\TransferTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TransferTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TransferTypeRepository
     */
    protected $transferTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->transferTypeRepo = \App::make(TransferTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_transfer_type()
    {
        $transferType = TransferType::factory()->make()->toArray();

        $createdTransferType = $this->transferTypeRepo->create($transferType);

        $createdTransferType = $createdTransferType->toArray();
        $this->assertArrayHasKey('id', $createdTransferType);
        $this->assertNotNull($createdTransferType['id'], 'Created TransferType must have id specified');
        $this->assertNotNull(TransferType::find($createdTransferType['id']), 'TransferType with given id must be in DB');
        $this->assertModelData($transferType, $createdTransferType);
    }

    /**
     * @test read
     */
    public function test_read_transfer_type()
    {
        $transferType = TransferType::factory()->create();

        $dbTransferType = $this->transferTypeRepo->find($transferType->id);

        $dbTransferType = $dbTransferType->toArray();
        $this->assertModelData($transferType->toArray(), $dbTransferType);
    }

    /**
     * @test update
     */
    public function test_update_transfer_type()
    {
        $transferType = TransferType::factory()->create();
        $fakeTransferType = TransferType::factory()->make()->toArray();

        $updatedTransferType = $this->transferTypeRepo->update($fakeTransferType, $transferType->id);

        $this->assertModelData($fakeTransferType, $updatedTransferType->toArray());
        $dbTransferType = $this->transferTypeRepo->find($transferType->id);
        $this->assertModelData($fakeTransferType, $dbTransferType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_transfer_type()
    {
        $transferType = TransferType::factory()->create();

        $resp = $this->transferTypeRepo->delete($transferType->id);

        $this->assertTrue($resp);
        $this->assertNull(TransferType::find($transferType->id), 'TransferType should not exist in DB');
    }
}
