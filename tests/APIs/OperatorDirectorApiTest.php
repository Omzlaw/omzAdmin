<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OperatorDirector;

class OperatorDirectorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_operator_director()
    {
        $operatorDirector = OperatorDirector::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/operator_directors', $operatorDirector
        );

        $this->assertApiResponse($operatorDirector);
    }

    /**
     * @test
     */
    public function test_read_operator_director()
    {
        $operatorDirector = OperatorDirector::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/operator_directors/'.$operatorDirector->id
        );

        $this->assertApiResponse($operatorDirector->toArray());
    }

    /**
     * @test
     */
    public function test_update_operator_director()
    {
        $operatorDirector = OperatorDirector::factory()->create();
        $editedOperatorDirector = OperatorDirector::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/operator_directors/'.$operatorDirector->id,
            $editedOperatorDirector
        );

        $this->assertApiResponse($editedOperatorDirector);
    }

    /**
     * @test
     */
    public function test_delete_operator_director()
    {
        $operatorDirector = OperatorDirector::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/operator_directors/'.$operatorDirector->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/operator_directors/'.$operatorDirector->id
        );

        $this->response->assertStatus(404);
    }
}
