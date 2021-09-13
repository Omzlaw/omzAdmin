<?php

namespace Database\Factories;

use App\Models\MatchUnavailablePlayer;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatchUnavailablePlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MatchUnavailablePlayer::class;

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
        'match_id' => $this->faker->randomDigitNotNull,
        'unavailable_player_id' => $this->faker->randomDigitNotNull
        ];
    }
}
