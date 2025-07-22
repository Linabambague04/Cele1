<?php

namespace Database\Factories;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResourceEvent>
 */
class ResourceEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'type' => $this->faker->randomElement(['material', 'equipo', 'herramienta']),
            'quantity' => $this->faker->numberBetween(1, 50),
            'event_id' => Event::factory(), // crea automáticamente un Event relacionado si no existe
        ];
    }
}
