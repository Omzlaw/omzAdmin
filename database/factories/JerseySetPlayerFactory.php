<?php

namespace Database\Factories;

use App\Models\JerseySetPlayer;
use Illuminate\Database\Eloquent\Factories\Factory;

class JerseySetPlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JerseySetPlayer::class;

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
        'jerset_set_id' => $this->faker->randomDigitNotNull,
        'player_id' => $this->faker->randomDigitNotNull,
        'jersey_number' => $this->faker->randomDigitNotNull
        ];
    }
}
