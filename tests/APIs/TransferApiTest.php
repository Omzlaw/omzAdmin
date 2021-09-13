<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Transfer;

class TransferApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_transfer()
    {
        $transfer = Transfer::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/transfers', $transfer
        );

        $this->assertApiResponse($transfer);
    }

    /**
     * @test
     */
    public function test_read_transfer()
    {
        $transfer = Transfer::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/transfers/'.$transfer->id
        );

        $this->assertApiResponse($transfer->toArray());
    }

    /**
     * @test
     */
    public function test_update_transfer()
    {
        $transfer = Transfer::factory()->create();
        $editedTransfer = Transfer::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/transfers/'.$transfer->id,
            $editedTransfer
        );

        $this->assertApiResponse($editedTransfer);
    }

    /**
     * @test
     */
    public function test_delete_transfer()
    {
        $transfer = Transfer::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/transfers/'.$transfer->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/transfers/'.$transfer->id
        );

        $this->response->assertStatus(404);
    }
}
