<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Player::class;

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
        'first_name' => $this->faker->word,
        'last_name' => $this->faker->word,
        'image' => $this->faker->word,
        'citizenship' => $this->faker->randomDigitNotNull,
        'second_citizenship' => $this->faker->randomDigitNotNull,
        'player_position_id' => $this->faker->randomDigitNotNull,
        'url' => $this->faker->word,
        'date_of_birth' => $this->faker->word,
        'date_of_death' => $this->faker->word,
        'gender' => $this->faker->randomDigitNotNull,
        'height' => $this->faker->randomDigitNotNull,
        'foot' => $this->faker->randomDigitNotNull,
        'retired' => $this->faker->randomDigitNotNull
        ];
    }
}
