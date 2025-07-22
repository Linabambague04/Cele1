<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RolesSeeder::class,]);
        $this->call([ResourceEventSeeder::class,]);
        $this->call([PaymentSeeder::class,]);
        $this->call([FeedbackSeeder::class,]);
        $this->call([NotificationSeeder::class,]);
        $this->call([MessageSeeder::class,]);
        $this->call([SupportSeeder::class,]);
        $this->call([ServiceSeeder::class,]);
        $this->call([EventServiceSeeder::class,]);
        $this->call([SecurityEventSeeder::class,]);
        $this->call([ActivityEventSeeder::class,]);
        $this->call([EventSeeder::class,]);
    }
}
