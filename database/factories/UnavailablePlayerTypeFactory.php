<?php

namespace Database\Factories;

use App\Models\UnavailablePlayerType;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnavailablePlayerTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UnavailablePlayerType::class;

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
        'description' => $this->faker->word
        ];
    }
}
