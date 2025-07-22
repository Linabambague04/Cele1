<?php

namespace Database\Factories;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => $this->faker->sentence(10),
            'rating' => $this->faker->numberBetween(1, 5),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'event_id' => Event::inRandomOrder()->value('id') ?? Event::factory(),
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
        ];
    }
}
