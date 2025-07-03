<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $roles = ['admin', 'editor', 'user', 'invitado', 'moderador']; // roles fijos

        return [
            'name' => $this->faker->unique()->randomElement($roles),// faker genera un rol aleatorio de la lista
        ];
    }
}
