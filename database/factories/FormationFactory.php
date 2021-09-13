<?php

namespace Database\Factories;

use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Formation::class;

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
        'x_position_1' => $this->faker->randomDigitNotNull,
        'x_position_2' => $this->faker->randomDigitNotNull,
        'x_position_3' => $this->faker->randomDigitNotNull,
        'x_position_4' => $this->faker->randomDigitNotNull,
        'x_position_5' => $this->faker->randomDigitNotNull,
        'x_position_6' => $this->faker->randomDigitNotNull,
        'x_position_7' => $this->faker->randomDigitNotNull,
        'x_position_8' => $this->faker->randomDigitNotNull,
        'x_position_9' => $this->faker->randomDigitNotNull,
        'x_position_10' => $this->faker->randomDigitNotNull,
        'x_position_11' => $this->faker->randomDigitNotNull,
        'y_postition_1' => $this->faker->randomDigitNotNull,
        'y_postition_2' => $this->faker->randomDigitNotNull,
        'y_postition_3' => $this->faker->randomDigitNotNull,
        'y_postition_4' => $this->faker->randomDigitNotNull,
        'y_postition_5' => $this->faker->randomDigitNotNull,
        'y_postition_6' => $this->faker->randomDigitNotNull,
        'y_postition_7' => $this->faker->randomDigitNotNull,
        'y_postition_8' => $this->faker->randomDigitNotNull,
        'y_postition_9' => $this->faker->randomDigitNotNull,
        'y_postition_10' => $this->faker->randomDigitNotNull,
        'y_postition_11' => $this->faker->randomDigitNotNull
        ];
    }
}
