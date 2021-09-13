<?php

namespace Database\Factories;

use App\Models\StaffAward;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffAwardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StaffAward::class;

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
        'staff_award_type_id' => $this->faker->randomDigitNotNull,
        'assignment_date' => $this->faker->word,
        'staff_id' => $this->faker->randomDigitNotNull
        ];
    }
}
