<?php

namespace Database\Factories;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetitionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Competition::class;

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
        'logo' => $this->faker->word,
        'type' => $this->faker->word,
        'rounds' => $this->faker->word,
        'rr_victory_points' => $this->faker->word,
        'rr_draw_points' => $this->faker->word,
        'rr_defeat_points' => $this->faker->word,
        'rr_sorting_order_1' => $this->faker->word,
        'rr_sorting_order_by_1' => $this->faker->word,
        'rr_sorting_order_2' => $this->faker->word,
        'rr_sorting_order_by_2' => $this->faker->word
        ];
    }
}
