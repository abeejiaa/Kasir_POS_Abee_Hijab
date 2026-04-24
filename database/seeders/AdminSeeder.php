<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Abee',
            'email' => 'admin@abeehijab.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir Abee',
            'email' => 'kasir@abeehijab.com',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
        ]);
    }
}