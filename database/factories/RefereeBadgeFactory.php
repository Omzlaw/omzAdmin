<?php

namespace Database\Factories;

use App\Models\RefereeBadge;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefereeBadgeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RefereeBadge::class;

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
        'referee_id' => $this->faker->randomDigitNotNull,
        'referee_badge_type_id' => $this->faker->randomDigitNotNull,
        'start_date' => $this->faker->word,
        'end_date' => $this->faker->word
        ];
    }
}
