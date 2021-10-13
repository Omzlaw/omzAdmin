<?php

namespace Database\Factories;

use App\Models\OperatorDirector;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperatorDirectorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OperatorDirector::class;

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
        'first_name' => $this->faker->word,
        'last_name' => $this->faker->word,
        'middle_name' => $this->faker->word,
        'phone_number' => $this->faker->word,
        'email' => $this->faker->word,
        'other_phone_number' => $this->faker->word,
        'is_director_shareholder' => $this->faker->word,
        'operator_id' => $this->faker->randomDigitNotNull,
        'applicant_id' => $this->faker->randomDigitNotNull,
        'shareholder_type' => $this->faker->randomDigitNotNull,
        'number_of_shares' => $this->faker->word
        ];
    }
}
