<?php namespace Tests\Repositories;

use App\Models\OperatorGame;
use App\Repositories\OperatorGameRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OperatorGameRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OperatorGameRepository
     */
    protected $operatorGameRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->operatorGameRepo = \App::make(OperatorGameRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_operator_game()
    {
        $operatorGame = OperatorGame::factory()->make()->toArray();

        $createdOperatorGame = $this->operatorGameRepo->create($operatorGame);

        $createdOperatorGame = $createdOperatorGame->toArray();
        $this->assertArrayHasKey('id', $createdOperatorGame);
        $this->assertNotNull($createdOperatorGame['id'], 'Created OperatorGame must have id specified');
        $this->assertNotNull(OperatorGame::find($createdOperatorGame['id']), 'OperatorGame with given id must be in DB');
        $this->assertModelData($operatorGame, $createdOperatorGame);
    }

    /**
     * @test read
     */
    public function test_read_operator_game()
    {
        $operatorGame = OperatorGame::factory()->create();

        $dbOperatorGame = $this->operatorGameRepo->find($operatorGame->id);

        $dbOperatorGame = $dbOperatorGame->toArray();
        $this->assertModelData($operatorGame->toArray(), $dbOperatorGame);
    }

    /**
     * @test update
     */
    public function test_update_operator_game()
    {
        $operatorGame = OperatorGame::factory()->create();
        $fakeOperatorGame = OperatorGame::factory()->make()->toArray();

        $updatedOperatorGame = $this->operatorGameRepo->update($fakeOperatorGame, $operatorGame->id);

        $this->assertModelData($fakeOperatorGame, $updatedOperatorGame->toArray());
        $dbOperatorGame = $this->operatorGameRepo->find($operatorGame->id);
        $this->assertModelData($fakeOperatorGame, $dbOperatorGame->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_operator_game()
    {
        $operatorGame = OperatorGame::factory()->create();

        $resp = $this->operatorGameRepo->delete($operatorGame->id);

        $this->assertTrue($resp);
        $this->assertNull(OperatorGame::find($operatorGame->id), 'OperatorGame should not exist in DB');
    }
}
