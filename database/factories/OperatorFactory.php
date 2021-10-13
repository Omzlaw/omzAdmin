<?php

namespace Database\Factories;

use App\Models\Operator;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperatorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Operator::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'RC_number' => $this->faker->word,
        'address' => $this->faker->word,
        'phone' => $this->faker->word,
        'website' => $this->faker->word,
        'logo' => $this->faker->word,
        'email' => $this->faker->word,
        'no_of_shareholders' => $this->faker->randomDigitNotNull,
        'shareholders_details' => $this->faker->text,
        'no_of_directors' => $this->faker->randomDigitNotNull,
        'directors_details' => $this->faker->text,
        'has_previously_applied' => $this->faker->word,
        'owners_convicted' => $this->faker->word,
        'conviction_details' => $this->faker->text,
        'Is_director_politician' => $this->faker->word,
        'has_pending_application' => $this->faker->word,
        'prev_application_details' => $this->faker->text,
        'is_shareholder_politician' => $this->faker->word,
        'accept_terms' => $this->faker->word,
        'application_status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
