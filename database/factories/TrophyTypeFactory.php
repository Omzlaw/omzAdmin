<?php

namespace Database\Factories;

use App\Models\TrophyType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrophyTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TrophyType::class;

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
        'logo' => $this->faker->word
        ];
    }
}
