<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class RemoveDummyNewsSeeder extends Seeder
{
    /**
     * Run the database seeds to remove dummy data.
     */
    public function run(): void
    {
        // Remove the dummy news articles we created
        News::where('title', 'MPSU Alumni Network Launches New Portal')->delete();
        News::where('title', 'Upcoming Homecoming Celebration 2026')->delete();
        News::where('title', 'Career Fair: Opportunities for Alumni')->delete();
        News::where('title', 'Alumni Achievement Spotlight: Sarah Martinez')->delete();
        News::where('title', 'New Scholarship Program for Alumni Children')->delete();
        News::where('title', 'Survey: Help Shape the Future of MPSU')->delete();
    }
}
