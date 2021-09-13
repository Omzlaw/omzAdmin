<?php

namespace Database\Factories;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agency::class;

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
        'full_name' => $this->faker->word,
        'address' => $this->faker->word,
        'tel' => $this->faker->word,
        'fax' => $this->faker->word,
        'website' => $this->faker->word,
        'status' => $this->faker->randomDigitNotNull
        ];
    }
}
