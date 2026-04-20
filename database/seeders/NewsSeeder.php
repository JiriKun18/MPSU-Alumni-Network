<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::create([
            'title' => 'MPSU Alumni Network Launches New Portal',
            'content' => 'We are excited to announce the official launch of the new MPSU Alumni Network portal! This platform connects all Mountain Province State University alumni and provides a space for networking, job opportunities, and community engagement. Join thousands of alumni members today!',
            'posted_by' => 1,
            'featured_image' => null,
            'is_published' => true,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        News::create([
            'title' => 'Upcoming Homecoming Celebration 2026',
            'content' => 'Mark your calendars! The MPSU Homecoming celebration is coming this March 2026. Join us for a weekend of reunions, networking events, and fun activities. All alumni are welcome to participate and reconnect with their batch mates and the university.',
            'posted_by' => 1,
            'featured_image' => null,
            'is_published' => true,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        News::create([
            'title' => 'Career Fair: Opportunities for Alumni',
            'content' => 'We are hosting a virtual career fair featuring leading companies and organizations looking to hire MPSU alumni. Companies include tech firms, government agencies, education institutions, and more. Register now to participate and explore career opportunities!',
            'posted_by' => 1,
            'featured_image' => null,
            'is_published' => true,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        News::create([
            'title' => 'Alumni Achievement Spotlight: Sarah Martinez',
            'content' => 'This month we feature Sarah Martinez, Class of 2018, who has recently become a Senior Software Engineer at a leading tech company. Sarah shares her journey from graduation to her current success and provides valuable insights for young professionals.',
            'posted_by' => 1,
            'featured_image' => null,
            'is_published' => true,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        News::create([
            'title' => 'New Scholarship Program for Alumni Children',
            'content' => 'MPSU is pleased to announce a new scholarship program for children of alumni. This initiative aims to support the next generation of students and strengthen our community. Learn more about eligibility requirements and how to apply on our website.',
            'posted_by' => 1,
            'featured_image' => null,
            'is_published' => true,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        News::create([
            'title' => 'Survey: Help Shape the Future of MPSU',
            'content' => 'We value your feedback! Please take 10 minutes to complete our alumni satisfaction survey. Your responses will help us improve our services and programs. All responses are anonymous and will be used to make meaningful improvements.',
            'posted_by' => 1,
            'featured_image' => null,
            'is_published' => true,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
