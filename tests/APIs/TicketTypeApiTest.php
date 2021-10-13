<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TicketType;

class TicketTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_ticket_type()
    {
        $ticketType = TicketType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/ticket_types', $ticketType
        );

        $this->assertApiResponse($ticketType);
    }

    /**
     * @test
     */
    public function test_read_ticket_type()
    {
        $ticketType = TicketType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/ticket_types/'.$ticketType->id
        );

        $this->assertApiResponse($ticketType->toArray());
    }

    /**
     * @test
     */
    public function test_update_ticket_type()
    {
        $ticketType = TicketType::factory()->create();
        $editedTicketType = TicketType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/ticket_types/'.$ticketType->id,
            $editedTicketType
        );

        $this->assertApiResponse($editedTicketType);
    }

    /**
     * @test
     */
    public function test_delete_ticket_type()
    {
        $ticketType = TicketType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/ticket_types/'.$ticketType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/ticket_types/'.$ticketType->id
        );

        $this->response->assertStatus(404);
    }
}
