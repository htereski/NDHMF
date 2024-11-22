<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{

    private array $status = [
        'ATIVO',
        'FECHADO'
    ];

    public function definition(): array
    {
        return [
            'subject' => $this->faker->city(),
            'status' => $this->faker->randomElement($this->status),
        ];
    }
}