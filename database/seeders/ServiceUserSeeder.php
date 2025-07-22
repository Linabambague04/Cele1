<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
class ServiceUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $services = Service::all();

        if ($users->isEmpty() || $services->isEmpty()) return;

        foreach ($users as $user) {
            $serviceCount = $services->count();
            $amount = min(rand(1, 3), $serviceCount);
            $randomServices = $services->random($amount)->pluck('id')->toArray();
            $user->services()->attach($randomServices);
        }
    }
}
