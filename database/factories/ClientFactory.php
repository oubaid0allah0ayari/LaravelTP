<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'        => $this->faker->name(),
            'email'      => $this->faker->unique()->safeEmail(),
            'telephone'  => $this->faker->optional(0.8)->phoneNumber(),
            'entreprise' => $this->faker->optional(0.7)->company(),
        ];
    }
}
