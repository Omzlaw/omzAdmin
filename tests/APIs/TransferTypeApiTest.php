<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TransferType;

class TransferTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_transfer_type()
    {
        $transferType = TransferType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/transfer_types', $transferType
        );

        $this->assertApiResponse($transferType);
    }

    /**
     * @test
     */
    public function test_read_transfer_type()
    {
        $transferType = TransferType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/transfer_types/'.$transferType->id
        );

        $this->assertApiResponse($transferType->toArray());
    }

    /**
     * @test
     */
    public function test_update_transfer_type()
    {
        $transferType = TransferType::factory()->create();
        $editedTransferType = TransferType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/transfer_types/'.$transferType->id,
            $editedTransferType
        );

        $this->assertApiResponse($editedTransferType);
    }

    /**
     * @test
     */
    public function test_delete_transfer_type()
    {
        $transferType = TransferType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/transfer_types/'.$transferType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/transfer_types/'.$transferType->id
        );

        $this->response->assertStatus(404);
    }
}
