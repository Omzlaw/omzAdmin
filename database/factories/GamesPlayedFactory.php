<?php

namespace Database\Factories;

use App\Models\GamesPlayed;
use Illuminate\Database\Eloquent\Factories\Factory;

class GamesPlayedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GamesPlayed::class;

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
        'operator_id' => $this->faker->randomDigitNotNull,
        'token' => $this->faker->word,
        'status' => $this->faker->randomDigitNotNull,
        'amount' => $this->faker->word,
        'type' => $this->faker->randomDigitNotNull,
        'scheme' => $this->faker->randomDigitNotNull
        ];
    }
}
