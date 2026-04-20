<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            // Bontoc Campus
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Arts in Political Science', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Science in Accountancy', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Science in Business Administration', 'major' => 'Financial Management'],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Science in Business Administration', 'major' => 'Marketing Management'],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Science in Criminology', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Elementary Education', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Special Needs Education', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Science in Secondary Education', 'major' => 'English'],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Science in Secondary Education', 'major' => 'Mathematics'],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Science in Secondary Education', 'major' => 'Science'],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Science in Secondary Education', 'major' => 'Social Studies'],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Early Childhood Education', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Science in Hospitality Management', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Associate of Arts in Hospitality Management', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Science in Information Technology', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Science in Nursing', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Science in Office Administration', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Bachelor of Science in Tourism Management', 'major' => null],
            
            // Tadian Campus
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Science in Agribusiness Management', 'major' => null],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Science in Agroforestry', 'major' => null],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Science in Forestry', 'major' => null],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Science in Civil Engineering', 'major' => null],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Science in Electrical Engineering', 'major' => null],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Science in Environmental Science', 'major' => null],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Science in Geodetic Engineering', 'major' => null],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Science in Elementary Education', 'major' => null],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Science in Secondary Education', 'major' => 'English'],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Science in Secondary Education', 'major' => 'Mathematics'],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Science in Secondary Education', 'major' => 'Science'],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Science in Secondary Education', 'major' => 'Social Studies'],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Technical – Vocational Teacher Education', 'major' => 'Civil and Construction Technology'],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Technical – Vocational Teacher Education', 'major' => 'Food Servicing Management'],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Technical – Vocational Teacher Education', 'major' => 'Electrical Technology'],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor of Technical – Vocational Teacher Education', 'major' => 'Garments and Fashion Designing'],
            ['campus' => 'Tadian Campus', 'course_name' => 'Bachelor in Agricultural Technology/ DAT – BAT', 'major' => null],
            
            // Paracelis Campus
            ['campus' => 'Paracelis Campus', 'course_name' => 'Bachelor in Agricultural Technology/ DAT – BAT', 'major' => null],
            
            // School of Advanced Education - Master's Programs
            ['campus' => 'Bontoc Campus', 'course_name' => 'Master of Arts in Education', 'major' => 'Administration and Supervision'],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Master in Business Administration', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Master in Public Administration', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Master of Arts in Science Education', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Master in IP Education and Rural Development', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Master of Arts in Teaching English', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Master in Criminal Justice Education', 'major' => 'Criminology'],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Master of Science in Rural Development', 'major' => null],
            
            // School of Advanced Education - Doctorate Programs
            ['campus' => 'Bontoc Campus', 'course_name' => 'Doctor of Education', 'major' => 'Educational Administration'],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Doctor of Business Administration', 'major' => null],
            ['campus' => 'Bontoc Campus', 'course_name' => 'Doctor of Philosophy in English Language Education', 'major' => null],
        ];

        DB::table('courses')->insert($courses);
    }
}
