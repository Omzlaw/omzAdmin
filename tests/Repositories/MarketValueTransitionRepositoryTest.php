<?php namespace Tests\Repositories;

use App\Models\MarketValueTransition;
use App\Repositories\MarketValueTransitionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MarketValueTransitionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MarketValueTransitionRepository
     */
    protected $marketValueTransitionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->marketValueTransitionRepo = \App::make(MarketValueTransitionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_market_value_transition()
    {
        $marketValueTransition = MarketValueTransition::factory()->make()->toArray();

        $createdMarketValueTransition = $this->marketValueTransitionRepo->create($marketValueTransition);

        $createdMarketValueTransition = $createdMarketValueTransition->toArray();
        $this->assertArrayHasKey('id', $createdMarketValueTransition);
        $this->assertNotNull($createdMarketValueTransition['id'], 'Created MarketValueTransition must have id specified');
        $this->assertNotNull(MarketValueTransition::find($createdMarketValueTransition['id']), 'MarketValueTransition with given id must be in DB');
        $this->assertModelData($marketValueTransition, $createdMarketValueTransition);
    }

    /**
     * @test read
     */
    public function test_read_market_value_transition()
    {
        $marketValueTransition = MarketValueTransition::factory()->create();

        $dbMarketValueTransition = $this->marketValueTransitionRepo->find($marketValueTransition->id);

        $dbMarketValueTransition = $dbMarketValueTransition->toArray();
        $this->assertModelData($marketValueTransition->toArray(), $dbMarketValueTransition);
    }

    /**
     * @test update
     */
    public function test_update_market_value_transition()
    {
        $marketValueTransition = MarketValueTransition::factory()->create();
        $fakeMarketValueTransition = MarketValueTransition::factory()->make()->toArray();

        $updatedMarketValueTransition = $this->marketValueTransitionRepo->update($fakeMarketValueTransition, $marketValueTransition->id);

        $this->assertModelData($fakeMarketValueTransition, $updatedMarketValueTransition->toArray());
        $dbMarketValueTransition = $this->marketValueTransitionRepo->find($marketValueTransition->id);
        $this->assertModelData($fakeMarketValueTransition, $dbMarketValueTransition->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_market_value_transition()
    {
        $marketValueTransition = MarketValueTransition::factory()->create();

        $resp = $this->marketValueTransitionRepo->delete($marketValueTransition->id);

        $this->assertTrue($resp);
        $this->assertNull(MarketValueTransition::find($marketValueTransition->id), 'MarketValueTransition should not exist in DB');
    }
}
