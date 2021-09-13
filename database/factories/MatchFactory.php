<?php

namespace Database\Factories;

use App\Models\Match;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Match::class;

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
        'name' => $this->faker->word,
        'description' => $this->faker->word,
        'competition_id' => $this->faker->randomDigitNotNull,
        'round' => $this->faker->randomDigitNotNull,
        'type' => $this->faker->randomDigitNotNull,
        'team_id_1' => $this->faker->randomDigitNotNull,
        'team_id_2' => $this->faker->randomDigitNotNull,
        'date' => $this->faker->word,
        'time' => $this->faker->word,
        'fh_additional_time' => $this->faker->randomDigitNotNull,
        'sh_additional_time' => $this->faker->randomDigitNotNull,
        'fh_extra_time_additional_time' => $this->faker->randomDigitNotNull,
        'sh_extra_time_additional_time' => $this->faker->randomDigitNotNull,
        'stadium_id' => $this->faker->randomDigitNotNull,
        'team_1_formation_id' => $this->faker->randomDigitNotNull,
        'team_2_formation_id' => $this->faker->randomDigitNotNull,
        'attendance' => $this->faker->randomDigitNotNull,
        'team_1_jersey_set_id' => $this->faker->randomDigitNotNull,
        'team_2_jersey_set_id' => $this->faker->randomDigitNotNull,
        'team_1_squad_player_id' => $this->faker->randomDigitNotNull,
        'team_1_squad_staff_id' => $this->faker->randomDigitNotNull,
        'team_2_squad_player_id' => $this->faker->randomDigitNotNull,
        'team_2_squad_staff_id' => $this->faker->randomDigitNotNull,
        'has_extra_time' => $this->faker->randomDigitNotNull
        ];
    }
}
