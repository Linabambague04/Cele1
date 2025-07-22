<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $events = Event::all();

        if ($users->isEmpty() || $events->isEmpty()) return;

        foreach ($events as $event) {
            $userCount = $users->count();
            $amount = min(rand(1, 3), $userCount);
            $randomUsers = $users->random($amount)->pluck('id')->toArray();
            $event->users()->attach($randomUsers);
        }
    }
}
