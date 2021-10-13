<?php namespace Tests\Repositories;

use App\Models\MailBox;
use App\Repositories\MailBoxRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MailBoxRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MailBoxRepository
     */
    protected $mailBoxRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->mailBoxRepo = \App::make(MailBoxRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_mail_box()
    {
        $mailBox = MailBox::factory()->make()->toArray();

        $createdMailBox = $this->mailBoxRepo->create($mailBox);

        $createdMailBox = $createdMailBox->toArray();
        $this->assertArrayHasKey('id', $createdMailBox);
        $this->assertNotNull($createdMailBox['id'], 'Created MailBox must have id specified');
        $this->assertNotNull(MailBox::find($createdMailBox['id']), 'MailBox with given id must be in DB');
        $this->assertModelData($mailBox, $createdMailBox);
    }

    /**
     * @test read
     */
    public function test_read_mail_box()
    {
        $mailBox = MailBox::factory()->create();

        $dbMailBox = $this->mailBoxRepo->find($mailBox->id);

        $dbMailBox = $dbMailBox->toArray();
        $this->assertModelData($mailBox->toArray(), $dbMailBox);
    }

    /**
     * @test update
     */
    public function test_update_mail_box()
    {
        $mailBox = MailBox::factory()->create();
        $fakeMailBox = MailBox::factory()->make()->toArray();

        $updatedMailBox = $this->mailBoxRepo->update($fakeMailBox, $mailBox->id);

        $this->assertModelData($fakeMailBox, $updatedMailBox->toArray());
        $dbMailBox = $this->mailBoxRepo->find($mailBox->id);
        $this->assertModelData($fakeMailBox, $dbMailBox->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_mail_box()
    {
        $mailBox = MailBox::factory()->create();

        $resp = $this->mailBoxRepo->delete($mailBox->id);

        $this->assertTrue($resp);
        $this->assertNull(MailBox::find($mailBox->id), 'MailBox should not exist in DB');
    }
}
