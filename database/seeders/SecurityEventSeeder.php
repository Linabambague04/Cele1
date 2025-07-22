<?php

namespace Database\Seeders;
use App\Models\SecurityEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecurityEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SecurityEvent::factory()->count(10)->create();
    }
}
