<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=> User::all()->random()->id,
            'chat_id' => Chat::all()->random()->id,
            'content' => $this->faker->paragraph(),
            'send_at'=> $this->faker->date() 
        ];
    }
}