<?php namespace Tests\Repositories;

use App\Models\TicketType;
use App\Repositories\TicketTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TicketTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TicketTypeRepository
     */
    protected $ticketTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->ticketTypeRepo = \App::make(TicketTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_ticket_type()
    {
        $ticketType = TicketType::factory()->make()->toArray();

        $createdTicketType = $this->ticketTypeRepo->create($ticketType);

        $createdTicketType = $createdTicketType->toArray();
        $this->assertArrayHasKey('id', $createdTicketType);
        $this->assertNotNull($createdTicketType['id'], 'Created TicketType must have id specified');
        $this->assertNotNull(TicketType::find($createdTicketType['id']), 'TicketType with given id must be in DB');
        $this->assertModelData($ticketType, $createdTicketType);
    }

    /**
     * @test read
     */
    public function test_read_ticket_type()
    {
        $ticketType = TicketType::factory()->create();

        $dbTicketType = $this->ticketTypeRepo->find($ticketType->id);

        $dbTicketType = $dbTicketType->toArray();
        $this->assertModelData($ticketType->toArray(), $dbTicketType);
    }

    /**
     * @test update
     */
    public function test_update_ticket_type()
    {
        $ticketType = TicketType::factory()->create();
        $fakeTicketType = TicketType::factory()->make()->toArray();

        $updatedTicketType = $this->ticketTypeRepo->update($fakeTicketType, $ticketType->id);

        $this->assertModelData($fakeTicketType, $updatedTicketType->toArray());
        $dbTicketType = $this->ticketTypeRepo->find($ticketType->id);
        $this->assertModelData($fakeTicketType, $dbTicketType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_ticket_type()
    {
        $ticketType = TicketType::factory()->create();

        $resp = $this->ticketTypeRepo->delete($ticketType->id);

        $this->assertTrue($resp);
        $this->assertNull(TicketType::find($ticketType->id), 'TicketType should not exist in DB');
    }
}
