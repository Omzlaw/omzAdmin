<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MarketValueTransition;

class MarketValueTransitionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_market_value_transition()
    {
        $marketValueTransition = MarketValueTransition::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/market_value_transitions', $marketValueTransition
        );

        $this->assertApiResponse($marketValueTransition);
    }

    /**
     * @test
     */
    public function test_read_market_value_transition()
    {
        $marketValueTransition = MarketValueTransition::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/market_value_transitions/'.$marketValueTransition->id
        );

        $this->assertApiResponse($marketValueTransition->toArray());
    }

    /**
     * @test
     */
    public function test_update_market_value_transition()
    {
        $marketValueTransition = MarketValueTransition::factory()->create();
        $editedMarketValueTransition = MarketValueTransition::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/market_value_transitions/'.$marketValueTransition->id,
            $editedMarketValueTransition
        );

        $this->assertApiResponse($editedMarketValueTransition);
    }

    /**
     * @test
     */
    public function test_delete_market_value_transition()
    {
        $marketValueTransition = MarketValueTransition::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/market_value_transitions/'.$marketValueTransition->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/market_value_transitions/'.$marketValueTransition->id
        );

        $this->response->assertStatus(404);
    }
}
