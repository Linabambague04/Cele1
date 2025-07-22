<?php

namespace Database\Factories;
use App\Models\Event;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventService>
 */
class EventServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['pendiente', 'aprobado', 'rechazado']),
            'event_id' => Event::inRandomOrder()->value('id') ?? Event::factory(),
            'service_id' => Service::inRandomOrder()->value('id') ?? Service::factory(),
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
        ];
    }
}
