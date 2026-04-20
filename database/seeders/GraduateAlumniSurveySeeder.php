<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\SurveyOption;

class GraduateAlumniSurveySeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $survey = Survey::firstOrCreate([
                'title' => 'Graduate Alumni Survey 2026',
            ], [
                'description' => 'Graduate Tracer Survey to assess employability and improve course offerings. Your responses are confidential.',
                'is_active' => true,
                'published_at' => Carbon::now(),
                'created_by' => 1,
            ]);

            $position = 1;

            // Consent
            $consent = SurveyQuestion::firstOrCreate([
                'survey_id' => $survey->id,
                'text' => 'I agree and give my consent to participate in the study.',
            ], [
                'type' => 'single',
                'is_required' => true,
                'position' => $position++,
            ]);
            SurveyOption::firstOrCreate([
                'survey_question_id' => $consent->id,
                'label' => 'I agree',
            ], [
                'value' => 'agree',
                'position' => 1,
            ]);

            // Name
            SurveyQuestion::firstOrCreate([
                'survey_id' => $survey->id,
                'text' => 'Name (Full Name)',
            ], [
                'type' => 'text',
                'is_required' => true,
                'position' => $position++,
            ]);

            // Course/Program Graduated
            $courseQ = SurveyQuestion::firstOrCreate([
                'survey_id' => $survey->id,
                'text' => 'Course/Program Graduated',
            ], [
                'type' => 'single',
                'is_required' => true,
                'position' => $position++,
            ]);
            $courses = [
                'Bachelor of Elementary Education',
                'Bachelor of Special Needs Education',
                'Bachelor of Science in Secondary Education - Major in English',
                'Bachelor of Science in Secondary Education - Major in Mathematics',
                'Bachelor of Science in Secondary Education - Major in Science',
                'Bachelor of Science in Secondary Education - Major in Social Studies',
                'Bachelor of Early Childhood Education',
                'Bachelor of Technical Vocational - Specialized in Civil Construction Technology',
                'Bachelor of Technical Vocational - Specialized in Food Servicing Management',
                'Bachelor of Technical Vocational - Specialized in Electrical Technology',
                'Bachelor of Technical Vocational - Specialized in Garments and Fashion Designing',
            ];
            $optPos = 1;
            foreach ($courses as $c) {
                SurveyOption::firstOrCreate([
                    'survey_question_id' => $courseQ->id,
                    'label' => $c,
                ], [
                    'value' => $c,
                    'position' => $optPos++,
                ]);
            }

            // Permanent Address
            SurveyQuestion::firstOrCreate([
                'survey_id' => $survey->id,
                'text' => 'Permanent Address',
            ], [
                'type' => 'text',
                'is_required' => true,
                'position' => $position++,
            ]);

            // Email Address
            SurveyQuestion::firstOrCreate([
                'survey_id' => $survey->id,
                'text' => 'Email Address',
            ], [
                'type' => 'text',
                'is_required' => true,
                'position' => $position++,
            ]);

            // Contact Number/s
            SurveyQuestion::firstOrCreate([
                'survey_id' => $survey->id,
                'text' => 'Contact Number/s',
            ], [
                'type' => 'text',
                'is_required' => true,
                'position' => $position++,
            ]);

            // Civil Status
            $civilStatusQ = SurveyQuestion::firstOrCreate([
                'survey_id' => $survey->id,
                'text' => 'Civil Status',
            ], [
                'type' => 'single',
                'is_required' => true,
                'position' => $position++,
            ]);
            foreach ([
                'Single', 'Married', 'Legally Separated', 'Widowed'
            ] as $i => $label) {
                SurveyOption::firstOrCreate([
                    'survey_question_id' => $civilStatusQ->id,
                    'label' => $label,
                ], [
                    'value' => strtolower(str_replace(' ', '_', $label)),
                    'position' => $i + 1,
                ]);
            }

            // Gender Preference
            $genderQ = SurveyQuestion::firstOrCreate([
                'survey_id' => $survey->id,
                'text' => 'Gender Preference',
            ], [
                'type' => 'single',
                'is_required' => true,
                'position' => $position++,
            ]);
            foreach ([
                'Male', 'Female', 'LGBTQ', 'Other'
            ] as $i => $label) {
                SurveyOption::firstOrCreate([
                    'survey_question_id' => $genderQ->id,
                    'label' => $label,
                ], [
                    'value' => strtolower($label),
                    'position' => $i + 1,
                ]);
            }

            // Year Graduated
            SurveyQuestion::firstOrCreate([
                'survey_id' => $survey->id,
                'text' => 'Year Graduated',
            ], [
                'type' => 'text',
                'is_required' => true,
                'position' => $position++,
            ]);

            // Present Occupation
            SurveyQuestion::firstOrCreate([
                'survey_id' => $survey->id,
                'text' => 'Present Occupation',
            ], [
                'type' => 'text',
                'is_required' => false,
                'position' => $position++,
            ]);

            // Place of Work
            SurveyQuestion::firstOrCreate([
                'survey_id' => $survey->id,
                'text' => 'Place of Work (Name of Company, Agency or Institution and address)',
            ], [
                'type' => 'text',
                'is_required' => false,
                'position' => $position++,
            ]);

            // Employment Status
            $employmentQ = SurveyQuestion::firstOrCreate([
                'survey_id' => $survey->id,
                'text' => 'Employment Data (Present Employment Status)',
            ], [
                'type' => 'single',
                'is_required' => false,
                'position' => $position++,
            ]);
            $employmentOptions = [
                'Permanent', 'Temporary', 'Contractual', 'Casual', 'Job Order', 'Private', 'Public', 'Self Employed', 'Not yet employed'
            ];
            foreach ($employmentOptions as $i => $label) {
                SurveyOption::firstOrCreate([
                    'survey_question_id' => $employmentQ->id,
                    'label' => $label,
                ], [
                    'value' => strtolower(str_replace(' ', '_', $label)),
                    'position' => $i + 1,
                ]);
            }
        });
    }
}
