<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->word,
        'ticket_type_id' => $this->faker->randomDigitNotNull,
        'complain' => $this->faker->word,
        'file_upoad' => $this->faker->word,
        'assigned_to' => $this->faker->randomDigitNotNull,
        'operator_id' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->randomDigitNotNull,
        'action_taken' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
