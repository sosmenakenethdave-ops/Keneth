<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin Account (Store Owner)
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@prizegas.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Cashier Account
        User::create([
            'name' => 'Cashier User',
            'email' => 'cashier@prizegas.com',
            'password' => Hash::make('password123'),
            'role' => 'cashier',
        ]);

        // 3. Staff Account
        User::create([
            'name' => 'Staff User',
            'email' => 'staff@prizegas.com',
            'password' => Hash::make('password123'),
            'role' => 'staff',
        ]);
    }
}