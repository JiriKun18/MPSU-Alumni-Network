<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Batch;
use App\Models\AlumniProfile;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@mpsu.edu',
            'password' => Hash::make('admin@123456'),
            'role' => 'admin',
            'is_active' => true,
            'is_verified' => true,
        ]);

        // Create sample batches
        $batches = [];
        for ($year = 2018; $year <= 2024; $year++) {
            $batches[] = Batch::create([
                'year' => $year,
                'description' => "Batch of $year",
            ]);
        }

        // Create sample alumni users
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => "Alumni User $i",
                'email' => "alumni$i@mpsu.edu",
                'password' => Hash::make('alumni@123456'),
                'role' => 'alumni',
                'is_active' => true,
                'is_verified' => true,
            ]);

            AlumniProfile::create([
                'user_id' => $user->id,
                'student_id' => "MPSU-20" . rand(18, 23) . "-" . str_pad($i, 4, '0', STR_PAD_LEFT),
                'batch_id' => $batches[array_rand($batches)]->id,
                'phone' => '09' . rand(100000000, 999999999),
                'bio' => "I am a dedicated alumni of Mountain Province State University.",
                'current_position' => ['Software Engineer', 'Product Manager', 'Data Analyst', 'Business Developer', 'System Administrator'][rand(0, 4)],
                'current_company' => ['Tech Corp', 'Digital Solutions', 'Innovation Labs', 'Data Systems Inc.', 'Web Services Ltd.'][rand(0, 4)],
                'date_of_birth' => now()->subYears(rand(25, 35)),
                'gender' => ['Male', 'Female'][rand(0, 1)],
                'address' => "Address $i, Mountain Province",
                'city' => 'Baguio',
                'province' => 'Mountain Province',
                'course' => ['BS Information Technology', 'BS Computer Science', 'BS Business Administration', 'BS Engineering'][rand(0, 3)],
            ]);
        }

        echo "Database seeded successfully!";
    }
}
