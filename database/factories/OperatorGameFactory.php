<?php

namespace Database\Factories;

use App\Models\OperatorGame;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperatorGameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OperatorGame::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'operator_id' => $this->faker->randomDigitNotNull,
        'name' => $this->faker->word,
        'amount' => $this->faker->word,
        'operator_scheme_id' => $this->faker->randomDigitNotNull,
        'how_it_works' => $this->faker->text,
        'status' => $this->faker->word,
        'remark' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
