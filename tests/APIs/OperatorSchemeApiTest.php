<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OperatorScheme;

class OperatorSchemeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_operator_scheme()
    {
        $operatorScheme = OperatorScheme::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/operator_schemes', $operatorScheme
        );

        $this->assertApiResponse($operatorScheme);
    }

    /**
     * @test
     */
    public function test_read_operator_scheme()
    {
        $operatorScheme = OperatorScheme::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/operator_schemes/'.$operatorScheme->id
        );

        $this->assertApiResponse($operatorScheme->toArray());
    }

    /**
     * @test
     */
    public function test_update_operator_scheme()
    {
        $operatorScheme = OperatorScheme::factory()->create();
        $editedOperatorScheme = OperatorScheme::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/operator_schemes/'.$operatorScheme->id,
            $editedOperatorScheme
        );

        $this->assertApiResponse($editedOperatorScheme);
    }

    /**
     * @test
     */
    public function test_delete_operator_scheme()
    {
        $operatorScheme = OperatorScheme::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/operator_schemes/'.$operatorScheme->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/operator_schemes/'.$operatorScheme->id
        );

        $this->response->assertStatus(404);
    }
}
