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

        // Generar entre 10 y 20 registros aleatorios
        $total = rand(10,20);

        for ($i = 0; $i < $total; $i++) {
            $randomUser = $users->random();
            $randomService = $services->random();
            $randomUser->services()->attach($randomService->id);
        }
    }
}
