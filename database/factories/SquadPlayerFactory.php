<?php

namespace Database\Factories;

use App\Models\SquadPlayer;
use Illuminate\Database\Eloquent\Factories\Factory;

class SquadPlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SquadPlayer::class;

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
        'player_id' => $this->faker->randomDigitNotNull,
        'squad_id' => $this->faker->randomDigitNotNull,
        'is_player_substitute' => $this->faker->randomDigitNotNull
        ];
    }
}
