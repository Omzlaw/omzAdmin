<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OperatorType;

class OperatorTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_operator_type()
    {
        $operatorType = OperatorType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/operator_types', $operatorType
        );

        $this->assertApiResponse($operatorType);
    }

    /**
     * @test
     */
    public function test_read_operator_type()
    {
        $operatorType = OperatorType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/operator_types/'.$operatorType->id
        );

        $this->assertApiResponse($operatorType->toArray());
    }

    /**
     * @test
     */
    public function test_update_operator_type()
    {
        $operatorType = OperatorType::factory()->create();
        $editedOperatorType = OperatorType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/operator_types/'.$operatorType->id,
            $editedOperatorType
        );

        $this->assertApiResponse($editedOperatorType);
    }

    /**
     * @test
     */
    public function test_delete_operator_type()
    {
        $operatorType = OperatorType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/operator_types/'.$operatorType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/operator_types/'.$operatorType->id
        );

        $this->response->assertStatus(404);
    }
}
