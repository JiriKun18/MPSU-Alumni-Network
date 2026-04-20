<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AlumniProfile;

class FixMissingAlumniProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alumniUsers = User::where('role', 'alumni')->get();
        $created = 0;
        foreach ($alumniUsers as $user) {
            if (!$user->alumniProfile) {
                AlumniProfile::create([
                    'user_id' => $user->id,
                    // Add more default fields if needed
                ]);
                $created++;
            }
        }
        $this->command->info("Created $created missing alumni profiles.");
    }
}
