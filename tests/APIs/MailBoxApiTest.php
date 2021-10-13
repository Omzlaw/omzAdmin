<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MailBox;

class MailBoxApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_mail_box()
    {
        $mailBox = MailBox::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/mail_boxes', $mailBox
        );

        $this->assertApiResponse($mailBox);
    }

    /**
     * @test
     */
    public function test_read_mail_box()
    {
        $mailBox = MailBox::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/mail_boxes/'.$mailBox->id
        );

        $this->assertApiResponse($mailBox->toArray());
    }

    /**
     * @test
     */
    public function test_update_mail_box()
    {
        $mailBox = MailBox::factory()->create();
        $editedMailBox = MailBox::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/mail_boxes/'.$mailBox->id,
            $editedMailBox
        );

        $this->assertApiResponse($editedMailBox);
    }

    /**
     * @test
     */
    public function test_delete_mail_box()
    {
        $mailBox = MailBox::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/mail_boxes/'.$mailBox->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/mail_boxes/'.$mailBox->id
        );

        $this->response->assertStatus(404);
    }
}
