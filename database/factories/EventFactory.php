<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

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
        'data' => $this->faker->randomDigitNotNull,
        'match_id' => $this->faker->randomDigitNotNull,
        'part' => $this->faker->randomDigitNotNull,
        'team_slot' => $this->faker->randomDigitNotNull,
        'time' => $this->faker->word,
        'additional_time' => $this->faker->word,
        'description' => $this->faker->word,
        'match_effect' => $this->faker->randomDigitNotNull,
        'player_id' => $this->faker->randomDigitNotNull,
        'player_id_substitution_in' => $this->faker->randomDigitNotNull,
        'player_id_substitution_out' => $this->faker->randomDigitNotNull,
        'staff_id' => $this->faker->randomDigitNotNull
        ];
    }
}
