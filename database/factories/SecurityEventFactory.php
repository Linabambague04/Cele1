<?php

namespace Database\Factories;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SecurityEvent>
 */
class SecurityEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'access_code' => $this->faker->bothify('AC-###??'),
            'incident' => $this->faker->sentence(),
            'date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'event_id' => Event::inRandomOrder()->value('id') ?? Event::factory(),
        ];
    }
}
