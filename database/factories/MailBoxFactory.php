<?php

namespace Database\Factories;

use App\Models\MailBox;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailBoxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MailBox::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->word,
        'subject' => $this->faker->word,
        'message' => $this->faker->text,
        'sent_by' => $this->faker->randomDigitNotNull,
        'received_by' => $this->faker->randomDigitNotNull,
        'is_read' => $this->faker->word,
        'sender_delete' => $this->faker->word,
        'receiver_delete' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
