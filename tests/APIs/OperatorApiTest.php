<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Operator;

class OperatorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_operator()
    {
        $operator = Operator::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/operators', $operator
        );

        $this->assertApiResponse($operator);
    }

    /**
     * @test
     */
    public function test_read_operator()
    {
        $operator = Operator::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/operators/'.$operator->id
        );

        $this->assertApiResponse($operator->toArray());
    }

    /**
     * @test
     */
    public function test_update_operator()
    {
        $operator = Operator::factory()->create();
        $editedOperator = Operator::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/operators/'.$operator->id,
            $editedOperator
        );

        $this->assertApiResponse($editedOperator);
    }

    /**
     * @test
     */
    public function test_delete_operator()
    {
        $operator = Operator::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/operators/'.$operator->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/operators/'.$operator->id
        );

        $this->response->assertStatus(404);
    }
}
