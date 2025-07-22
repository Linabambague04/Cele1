<?php

namespace Database\Seeders;
use App\Models\ResourceEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ResourceEvent::factory()->count(10)->create();
    }
}
