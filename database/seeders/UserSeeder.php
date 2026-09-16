<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('nama', 'admin')->firstOrFail();
        $kasirRole = Role::where('nama', 'kasir')->firstOrFail();

        User::updateOrCreate(
            ['email' => 'admin@k5mart.test'],
            [
                'name' => 'Faiq Ahzha',
                'password' => Hash::make('password123'),
                'role_id' => $adminRole->id,
            ]
        );

        User::updateOrCreate(
            ['email' => 'kasir@k5mart.test'],
            [
                'name' => 'Faiq',
                'password' => Hash::make('password123'),
                'role_id' => $kasirRole->id,
            ]
        );
    }
}
