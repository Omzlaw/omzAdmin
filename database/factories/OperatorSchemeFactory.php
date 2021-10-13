<?php

namespace Database\Factories;

use App\Models\OperatorScheme;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperatorSchemeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OperatorScheme::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'play_mode' => $this->faker->word,
        'description' => $this->faker->word,
        'operator_id' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->word,
        'start_date' => $this->faker->word,
        'end_date' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
