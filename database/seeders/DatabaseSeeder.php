<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Admin Account
        User::updateOrCreate(
            ['email' => 'admin@cfcst.edu.ph'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'role' => 'admin', 
                'status' => 'active',
            ]
        );

        // 2. Instructor Account
        User::updateOrCreate(
            ['email' => 'instructor@cfcst.edu.ph'],
            [
                'name' => 'Instructor User',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'status' => 'active',
            ]
        );

        // 3. Student Account
        User::updateOrCreate(
            ['email' => 'student@cfcst.edu.ph'],
            [
                'name' => 'Student User',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'active',
            ]
        );

        // --- IDAGDAG ITO PARA MA-CALL ANG CURRICULUM SEEDER ---
        $this->call([
            CurriculumSeeder::class,
            RoomSeeder::class,
        ]);
    }
}