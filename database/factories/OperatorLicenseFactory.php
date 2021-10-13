<?php

namespace Database\Factories;

use App\Models\OperatorLicense;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperatorLicenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OperatorLicense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_no' => $this->faker->word,
        'operator_id' => $this->faker->randomDigitNotNull,
        'license_type_id' => $this->faker->randomDigitNotNull,
        'due_date' => $this->faker->word,
        'date_last_paid' => $this->faker->word,
        'status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
