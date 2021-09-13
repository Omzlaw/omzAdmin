<?php

namespace Database\Factories;

use App\Models\MatchReferee;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatchRefereeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MatchReferee::class;

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
        'match_id' => $this->faker->randomDigitNotNull,
        'referee_id' => $this->faker->randomDigitNotNull
        ];
    }
}
