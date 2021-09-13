<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

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
        'image' => $this->faker->word,
        'citizenship' => $this->faker->randomDigitNotNull,
        'second_citizenship' => $this->faker->randomDigitNotNull,
        'staff_type_id' => $this->faker->randomDigitNotNull,
        'retired' => $this->faker->randomDigitNotNull,
        'gender' => $this->faker->randomDigitNotNull,
        'date_of_birth' => $this->faker->word,
        'date_of_death' => $this->faker->word
        ];
    }
}
