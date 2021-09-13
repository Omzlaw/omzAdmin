<?php

namespace Database\Factories;

use App\Models\PlayerPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerPositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlayerPosition::class;

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
        'abbreviation' => $this->faker->word
        ];
    }
}
