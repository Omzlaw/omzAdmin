<?php

namespace Database\Factories;

use App\Models\CompetitonTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetitonTeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompetitonTeam::class;

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
        'competition_id' => $this->faker->randomDigitNotNull,
        'team_id' => $this->faker->randomDigitNotNull
        ];
    }
}
