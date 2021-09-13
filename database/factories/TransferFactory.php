<?php

namespace Database\Factories;

use App\Models\Transfer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transfer::class;

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
        'player_id' => $this->faker->randomDigitNotNull,
        'date' => $this->faker->word,
        'team_id_left' => $this->faker->randomDigitNotNull,
        'team_id_joined' => $this->faker->randomDigitNotNull,
        'fee' => $this->faker->word,
        'transfer_type_id' => $this->faker->randomDigitNotNull
        ];
    }
}
