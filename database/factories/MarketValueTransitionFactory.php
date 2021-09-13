<?php

namespace Database\Factories;

use App\Models\MarketValueTransition;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketValueTransitionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MarketValueTransition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'date' => $this->faker->word,
        'value' => $this->faker->word,
        'player_id' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->randomDigitNotNull
        ];
    }
}
