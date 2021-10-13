<?php

namespace Database\Factories;

use App\Models\MonitoringLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonitoringLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MonitoringLog::class;

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
        'operator' => $this->faker->word,
        'operator_id' => $this->faker->randomDigitNotNull,
        'website' => $this->faker->word,
        'status' => $this->faker->word
        ];
    }
}
