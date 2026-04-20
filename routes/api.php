<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Course;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Location data endpoints
Route::get('/locations/countries', [App\Http\Controllers\LocationController::class, 'countries']);
Route::get('/locations/philippines/regions', [App\Http\Controllers\LocationController::class, 'getPhilippinesRegions']);
Route::get('/locations/philippines/provinces/{regionCode}', [App\Http\Controllers\LocationController::class, 'provinces']);
Route::get('/locations/cities/{provinceCode}', [App\Http\Controllers\LocationController::class, 'cities']);
Route::get('/locations/barangays/{cityCode}', [App\Http\Controllers\LocationController::class, 'barangays']);

// Legacy routes for backward compatibility
Route::get('/regions', [App\Http\Controllers\LocationController::class, 'regions']);
Route::get('/regions/{regionCode}/provinces', [App\Http\Controllers\LocationController::class, 'provinces']);
Route::get('/provinces/{provinceCode}/cities', [App\Http\Controllers\LocationController::class, 'cities']);
Route::get('/provinces/{provinceCode}/municipalities', [App\Http\Controllers\LocationController::class, 'municipalities']);
Route::get('/cities/{code}/barangays', [App\Http\Controllers\LocationController::class, 'barangays']);
Route::get('/municipalities/{code}/barangays', [App\Http\Controllers\LocationController::class, 'barangays']);

// Get courses by campus
Route::get('/courses', function (Request $request) {
    $campus = trim((string) $request->query('campus', ''));
    
    if ($campus === '') {
        return response()->json([]);
    }

    $courses = Course::whereRaw('LOWER(TRIM(campus)) = ?', [strtolower($campus)])
        ->orderBy('course_name')
        ->orderBy('major')
        ->get();
    
    // Format courses with major if exists
    $formattedCourses = $courses->map(function ($course) {
        return [
            'id' => $course->id,
            'course_name' => $course->course_name,
            'major' => $course->major,
            'display' => $course->major
                ? $course->course_name . ' - ' . $course->major
                : $course->course_name
        ];
    });

    // Keep graduate offerings visible for older databases that were seeded
    // before masteral/doctorate rows were added.
    $graduateFallbackByCampus = [
        'Bontoc Campus' => [
            ['course_name' => 'Master of Arts in Education', 'major' => 'Administration and Supervision'],
            ['course_name' => 'Master in Business Administration', 'major' => null],
            ['course_name' => 'Master in Public Administration', 'major' => null],
            ['course_name' => 'Master of Arts in Science Education', 'major' => null],
            ['course_name' => 'Master in IP Education and Rural Development', 'major' => null],
            ['course_name' => 'Master of Arts in Teaching English', 'major' => null],
            ['course_name' => 'Master in Criminal Justice Education', 'major' => 'Criminology'],
            ['course_name' => 'Master of Science in Rural Development', 'major' => null],
            ['course_name' => 'Doctor of Education', 'major' => 'Educational Administration'],
            ['course_name' => 'Doctor of Business Administration', 'major' => null],
            ['course_name' => 'Doctor of Philosophy in English Language Education', 'major' => null],
        ],
    ];

    foreach ($graduateFallbackByCampus[$campus] ?? [] as $fallbackCourse) {
        $exists = $formattedCourses->contains(function ($course) use ($fallbackCourse) {
            return strcasecmp((string) $course['course_name'], (string) $fallbackCourse['course_name']) === 0
                && strcasecmp((string) ($course['major'] ?? ''), (string) ($fallbackCourse['major'] ?? '')) === 0;
        });

        if (!$exists) {
            $formattedCourses->push([
                'id' => null,
                'course_name' => $fallbackCourse['course_name'],
                'major' => $fallbackCourse['major'],
                'display' => $fallbackCourse['major']
                    ? $fallbackCourse['course_name'] . ' - ' . $fallbackCourse['major']
                    : $fallbackCourse['course_name'],
            ]);
        }
    }

    $formattedCourses = $formattedCourses
        ->sortBy(function ($course) {
            return strtolower($course['display']);
        })
        ->values();
    
    return response()->json($formattedCourses);
});
