<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AlumniProfile;
use App\Models\JobPosting;
use App\Models\Event;
use App\Models\News;
use App\Models\Survey;
use App\Models\SurveyResponse;

class ReportController extends Controller
{
    /**
     * Display analytics and reports dashboard
     */
    public function index()
    {
        // User Statistics
        $totalUsers = User::count();
        $activeAlumni = AlumniProfile::whereNotNull('occupation')->count();
        $verifiedUsers = User::where('email_verified_at', '!=', null)->count();
        $unverifiedUsers = User::where('email_verified_at', null)->count();
        $inactiveUsers = User::whereDate('updated_at', '<', now()->subDays(90))->count();

        // Content Statistics
        $totalJobs = JobPosting::count();
        $totalEvents = Event::count();
        $totalNews = News::count();

        // Engagement Statistics
        // Survey Statistics
        $activeSurveys = Survey::where('is_active', true)->count();
        $surveyResponses = SurveyResponse::count();
        $responseRate = $totalUsers > 0 ? round(($surveyResponses / $totalUsers) * 100) : 0;

        return view('admin.reports.index', compact(
            'totalUsers',
            'activeAlumni',
            'verifiedUsers',
            'unverifiedUsers',
            'inactiveUsers',
            'totalJobs',
            'totalEvents',
            'totalNews',
            'activeSurveys',
            'surveyResponses',
            'responseRate'
        ));
    }

    /**
     * Export reports in various formats
     */
    public function export($format = 'csv')
    {
        // Collect all data
        $data = [
            'generated_at' => now()->format('Y-m-d H:i:s'),
            'summary' => [
                'total_users' => User::count(),
                'active_alumni' => AlumniProfile::whereNotNull('occupation')->count(),
                'verified_users' => User::where('email_verified_at', '!=', null)->count(),
                'job_postings' => JobPosting::count(),
                'events' => Event::count(),
                'news_articles' => News::count(),
                'survey_responses' => SurveyResponse::count(),
            ],
            'users' => User::with('alumniProfile')->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'batch' => $user->batch,
                    'verified' => $user->email_verified_at ? 'Yes' : 'No',
                    'created_at' => $user->created_at->format('Y-m-d'),
                    'occupation' => $user->alumniProfile?->occupation ?? 'Not provided',
                ];
            })->toArray(),
        ];

        if ($format === 'json') {
            return response()->json($data, 200, [
                'Content-Disposition' => 'attachment; filename=alumni_report_' . date('Y-m-d_His') . '.json'
            ]);
        } elseif ($format === 'csv') {
            return $this->exportToCSV($data);
        } elseif ($format === 'pdf') {
            return $this->exportToPDF($data);
        }

        return redirect()->back()->with('error', 'Invalid export format');
    }

    /**
     * Export to CSV format
     */
    private function exportToCSV($data)
    {
        $filename = 'alumni_report_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=$filename",
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM

            // Summary Section
            fputcsv($file, ['ALUMNI SYSTEM REPORT']);
            fputcsv($file, ['Generated At', $data['generated_at']]);
            fputcsv($file, []);

            // Summary Statistics
            fputcsv($file, ['SUMMARY STATISTICS']);
            fputcsv($file, ['Metric', 'Count']);
            foreach ($data['summary'] as $key => $value) {
                fputcsv($file, [ucfirst(str_replace('_', ' ', $key)), $value]);
            }
            fputcsv($file, []);

            // Users Section
            fputcsv($file, ['USER DETAILS']);
            fputcsv($file, ['ID', 'Name', 'Email', 'Batch', 'Verified', 'Created At', 'Occupation']);
            foreach ($data['users'] as $user) {
                fputcsv($file, $user);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export to PDF format (basic text)
     */
    private function exportToPDF($data)
    {
        $filename = 'alumni_report_' . date('Y-m-d_His') . '.txt';
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=$filename",
        ];

        $content = "ALUMNI SYSTEM REPORT\n";
        $content .= "Generated: " . $data['generated_at'] . "\n";
        $content .= str_repeat("=", 80) . "\n\n";

        $content .= "SUMMARY STATISTICS\n";
        $content .= str_repeat("-", 40) . "\n";
        foreach ($data['summary'] as $key => $value) {
            $content .= ucfirst(str_replace('_', ' ', $key)) . ": " . $value . "\n";
        }
        $content .= "\n";

        $content .= "USER DETAILS\n";
        $content .= str_repeat("-", 40) . "\n";
        foreach ($data['users'] as $user) {
            $content .= "ID: " . $user['id'] . " | Name: " . $user['name'] . " | Email: " . $user['email'] . "\n";
        }

        return response($content, 200, $headers);
    }
}
