<?php

namespace Database\Factories;

use App\Models\RankingTransition;
use Illuminate\Database\Eloquent\Factories\Factory;

class RankingTransitionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RankingTransition::class;

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
        'ranking_type_id' => $this->faker->randomDigitNotNull,
        'value' => $this->faker->randomDigitNotNull,
        'team_id' => $this->faker->randomDigitNotNull,
        'date' => $this->faker->word
        ];
    }
}
