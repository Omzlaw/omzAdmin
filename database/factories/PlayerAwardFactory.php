<?php

namespace Database\Factories;

use App\Models\PlayerAward;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerAwardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlayerAward::class;

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
        'assignement_date' => $this->faker->word,
        'player_award_type_id' => $this->faker->randomDigitNotNull,
        'player_id' => $this->faker->randomDigitNotNull
        ];
    }
}
