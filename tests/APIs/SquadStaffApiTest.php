<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SquadStaff;

class SquadStaffApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_squad_staff()
    {
        $squadStaff = SquadStaff::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/squad_staffs', $squadStaff
        );

        $this->assertApiResponse($squadStaff);
    }

    /**
     * @test
     */
    public function test_read_squad_staff()
    {
        $squadStaff = SquadStaff::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/squad_staffs/'.$squadStaff->id
        );

        $this->assertApiResponse($squadStaff->toArray());
    }

    /**
     * @test
     */
    public function test_update_squad_staff()
    {
        $squadStaff = SquadStaff::factory()->create();
        $editedSquadStaff = SquadStaff::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/squad_staffs/'.$squadStaff->id,
            $editedSquadStaff
        );

        $this->assertApiResponse($editedSquadStaff);
    }

    /**
     * @test
     */
    public function test_delete_squad_staff()
    {
        $squadStaff = SquadStaff::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/squad_staffs/'.$squadStaff->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/squad_staffs/'.$squadStaff->id
        );

        $this->response->assertStatus(404);
    }
}
