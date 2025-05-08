<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    return [
        'ci' => $this->faker->unique()->numerify('########'), // 8 dígitos numéricos
        'nombre' => $this->faker->name(),
        'correo' => $this->faker->unique()->safeEmail(),
        'contrasena' => bcrypt('password'), // puedes usar bcrypt o Hash::make si quieres encriptar
        'telefono' => $this->faker->optional()->phoneNumber(),
        'direccion' => $this->faker->optional()->address(),
        'estado' => $this->faker->boolean(90), // 90% probabilidad de true
    ];
    }
}
