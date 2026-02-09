<?php

namespace Database\Factories;

use App\Models\CicloFormativo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CicloFormativo>
 */
class CicloFormativoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'familia_profesional_id' => random_int(1, 10),
            'nombre' => fake()->word(),
            'codigo' => fake()->word(),
            'grado' => fake()->randomElement(CicloFormativo::GRADOS),
            'descripcion' => fake()->sentence(),
        ];
    }
}
