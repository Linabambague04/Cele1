<?php

namespace Database\Factories;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActivityEvent>
 */
class ActivityEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'activity_type' => $this->faker->randomElement(['Ingreso', 'Salida', 'Alerta', 'Incidente']),
            'status' => $this->faker->randomElement(['activo', 'inactivo', 'pendiente']),
            'event_id' => Event::inRandomOrder()->value('id') ?? Event::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
