<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

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
        'type' => $this->faker->randomDigitNotNull,
        'foundation_date' => $this->faker->word,
        'stadium_id' => $this->faker->randomDigitNotNull,
        'full_name' => $this->faker->word,
        'address' => $this->faker->word,
        'tel' => $this->faker->word,
        'fax' => $this->faker->word,
        'website' => $this->faker->word,
        'club_nation' => $this->faker->word,
        'national_team_confederation' => $this->faker->randomDigitNotNull
        ];
    }
}
