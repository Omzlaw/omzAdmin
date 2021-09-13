<?php

namespace Database\Factories;

use App\Models\TeamContract;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeamContract::class;

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
        'start_date' => $this->faker->word,
        'end_date' => $this->faker->word,
        'salary' => $this->faker->word,
        'team_id' => $this->faker->randomDigitNotNull
        ];
    }
}
