<?php

namespace Database\Factories;

use App\Models\Trophy;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrophyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trophy::class;

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
        'trophy_type_id' => $this->faker->randomDigitNotNull,
        'team_id' => $this->faker->randomDigitNotNull,
        'assignment_date' => $this->faker->word
        ];
    }
}
