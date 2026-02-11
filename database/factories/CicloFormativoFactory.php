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

            'nombre' => fake()->word(),
            'codigo' => fake()->word(),
            'grado' => fake()->randomElement(['BÁSICA', 'G.M.', 'G.S.', 'C.E. (G.M.)', 'C.E. (G.S.)','basico', 'medio', 'superior']),
            'descripcion' => fake()->sentence(),
        ];
    }
}
