<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use  App\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $roles = Role::all();

        if ($users->isEmpty() || $roles->isEmpty()) return;

        // Generar 10 asignaciones únicas de usuario ↔ rol
        for ($i = 0; $i < 10; $i++) {
            $user = $users->random();
            $role = $roles->random();

            // Evita duplicados
            $user->roles()->syncWithoutDetaching([$role->id]);
        }
    }
}
