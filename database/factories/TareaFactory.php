<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarea>
 */
class TareaFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha_apertura' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'fecha_cierre' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'activo' => fake()->boolean(),
            'enunciado' => fake()->text(),
        ];
    }

    /**
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'activo' => null,
        ]);
    }
}
