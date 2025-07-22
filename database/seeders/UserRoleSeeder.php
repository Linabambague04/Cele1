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

        foreach ($users as $user) {
            $roleCount = $roles->count();
            $amount = min(rand(1, 2), $roleCount);
            $randomRoles = $roles->random($amount)->pluck('id')->toArray();
            $user->roles()->attach($randomRoles);
        }
    }
}
