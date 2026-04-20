<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlumniProfile;
use App\Models\Batch;
use App\Models\SurveyResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AlumniDirectoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'admin') {
                return redirect('/')->with('error', 'Unauthorized access');
            }
            return $next($request);
        });
    }

    /**
     * Display alumni directory for admin (full details)
     */
    public function index(Request $request)
    {
        // Default to showing verified users only
        if (!$request->filled('verified')) {
            $request->merge(['verified' => 'verified']);
        }

        $query = $this->buildFilteredQuery($request);

        $alumni = $query->orderBy('name')->paginate(15);

        // Get available batches dynamically from existing alumni registrations only
        $batchesQuery = Batch::whereHas('alumniProfiles', function ($q) use ($request) {
            $q->whereHas('user', function ($userQ) use ($request) {
                $userQ->where('role', 'alumni');

                if ($request->filled('verified')) {
                    if ($request->verified === 'verified') {
                        $userQ->where('is_verified', true)
                            ->where('is_active', true);
                    } elseif ($request->verified === 'unverified') {
                        $userQ->where(function ($statusQ) {
                            $statusQ->where('is_verified', false)
                                ->orWhere('is_active', false);
                        });
                    }
                }
            });

            if ($request->filled('course')) {
                $q->where(function ($subQ) use ($request) {
                    $subQ->where('course', $request->course)
                        ->orWhere('course_graduated', $request->course);
                });
            }
        })->orderBy('year', 'desc');

        $batches = $batchesQuery->get();

        // Get available courses dynamically from existing alumni registrations only
        $coursesQuery = AlumniProfile::query()
            ->whereHas('user', function ($userQ) use ($request) {
                $userQ->where('role', 'alumni');

                if ($request->filled('verified')) {
                    if ($request->verified === 'verified') {
                        $userQ->where('is_verified', true)
                            ->where('is_active', true);
                    } elseif ($request->verified === 'unverified') {
                        $userQ->where(function ($statusQ) {
                            $statusQ->where('is_verified', false)
                                ->orWhere('is_active', false);
                        });
                    }
                }
            })
            ->where(function ($q) {
                $q->whereNotNull('course')
                    ->orWhereNotNull('course_graduated');
            });

        if ($request->filled('batch')) {
            $coursesQuery->where('batch_id', $request->batch);
        }

        $courses = $coursesQuery->get()
            ->flatMap(function ($profile) {
                return [$profile->course, $profile->course_graduated];
            })
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('admin.alumni-directory', compact('alumni', 'batches', 'courses'));
    }

    /**
     * Export filtered alumni list as CSV
     */
    public function export(Request $request)
    {
        $query = $this->buildFilteredQuery($request);
        $excludedNames = ['alumni2','alumni3','alumni4','alumni5','alumni6','alumni7','alumni8','alumni9','alumni10'];

        $alumni = $query->orderBy('name')->get()->reject(function ($alumnus) use ($excludedNames) {
            return in_array($alumnus->name, $excludedNames, true);
        });

        $batchYear = null;
        if ($request->filled('batch')) {
            $batch = Batch::find($request->batch);
            $batchYear = $batch ? $batch->year : null;
        }

        $courseLabel = $request->filled('course') ? $request->course : null;
        $safeCourse = $courseLabel ? trim(preg_replace('/[^A-Za-z0-9]+/', '-', $courseLabel), '-') : null;
        $baseName = 'alumni-directory';
        $fileName = $baseName
            . ($safeCourse ? '-' . $safeCourse : '')
            . ($batchYear ? '-' . $batchYear : '')
            . '-' . now()->format('Y-m-d')
            . '.csv';

        return response()->streamDownload(function () use ($alumni) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Name', 'Email', 'Course', 'Batch Year', 'Status', 'Contact Number']);

            foreach ($alumni as $alumnus) {
                /** @var User $alumnus */
                $profile = $alumnus->alumniProfile;
                $name = $alumnus->name;
                if ($profile && ($profile->family_name || $profile->given_name)) {
                    $name = trim(sprintf(
                        '%s, %s %s %s',
                        $profile->family_name,
                        $profile->given_name,
                        $profile->middle_initial,
                        $profile->suffix
                    ));
                }

                $course = $profile->course ?? '';
                $batchYear = $profile && $profile->batch ? $profile->batch->year : '';
                $status = ($alumnus->is_active ? 'Active' : 'Inactive') . ' / ' . ($alumnus->is_verified ? 'Verified' : 'Unverified');
                $phone = $profile->phone ?? '';

                fputcsv($handle, [$name, $alumnus->email, $course, $batchYear, $status, $phone]);
            }

            fclose($handle);
        }, $fileName, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /**
     * Print filtered alumni list
     */
    public function print(Request $request)
    {
        $query = $this->buildFilteredQuery($request);
        $excludedNames = ['alumni2','alumni3','alumni4','alumni5','alumni6','alumni7','alumni8','alumni9','alumni10'];

        $alumni = $query->orderBy('name')->get()->reject(function ($alumnus) use ($excludedNames) {
            return in_array($alumnus->name, $excludedNames, true);
        })->map(function (User $alumnus) {
            $profile = $alumnus->alumniProfile;
            
            // Get address
            $addressParts = [];
            if ($profile) {
                if ($profile->present_address) $addressParts[] = $profile->present_address;
                if ($profile->present_city) $addressParts[] = $profile->present_city;
                if ($profile->present_province) $addressParts[] = $profile->present_province;
                if ($profile->present_region) $addressParts[] = $profile->present_region;
                if ($profile->present_country) $addressParts[] = $profile->present_country;
            }
            $address = count($addressParts) > 0 ? implode(', ', $addressParts) : 'Not Provided';
            
            // Get employment status - prefer occupation_type, fallback to employment_status
            $employmentStatus = 'Unemployed';
            if ($profile && $profile->occupation_type) {
                $employmentStatus = $profile->occupation_type;
            } elseif ($profile && $profile->employment_status) {
                $employmentStatus = $profile->employment_status;
            }
            
            return [
                'name' => $alumnus->name,
                'email' => $alumnus->email,
                'phone' => $profile?->phone ?? 'N/A',
                'course' => $profile?->course ?? $profile?->course_graduated ?? 'N/A',
                'batch_year' => $profile?->batch?->year ?? 'N/A',
                'address' => $address,
                'employment_status' => $employmentStatus,
                'employment_type' => $profile?->employment_type ?? null,
            ];
        });

        $filters = [
            'batch' => $request->filled('batch') ? Batch::find($request->batch)?->year : null,
            'course' => $request->filled('course') ? $request->course : null,
            'search' => $request->filled('search') ? $request->search : null,
        ];

        return view('admin.alumni-print', compact('alumni', 'filters'));
    }

    /**
     * Show full detailed profile for admin
     */
    public function show($id)
    {
        $user = User::with([
            'alumniProfile.batch',
            'jobApplications.jobPosting',
            'eventRegistrations.event'
        ])->findOrFail($id);

        return view('admin.alumni-profile-view', compact('user'));
    }

    /**
     * Delete an alumni account
     */
    public function destroy($id)
    {
        try {
            $user = User::with('alumniProfile')->findOrFail($id);
            
            // Verify it's an alumni account
            if ($user->role !== 'alumni') {
                return redirect()->back()->with('error', 'Cannot delete non-alumni users from this interface.');
            }

            $userName = $user->name;

            DB::transaction(function () use ($user) {
                $profile = $user->alumniProfile;

                SurveyResponse::where('user_id', $user->id)->delete();

                if ($profile) {
                    $this->deleteStoredFiles([
                        $profile->profile_picture ?? null,
                        $profile->proof_of_employment ?? null,
                    ]);

                    $verificationDocuments = $profile->verification_documents ?? [];

                    if (is_string($verificationDocuments)) {
                        $verificationDocuments = json_decode($verificationDocuments, true) ?? [];
                    }

                    if (is_array($verificationDocuments)) {
                        $this->deleteStoredFiles($verificationDocuments);
                    }
                }

                $user->delete();
            });

            return redirect()->route('admin.alumni-directory.index')
                ->with('success', "Alumni account '{$userName}' has been successfully deleted.");
                
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete alumni account: ' . $e->getMessage());
        }
    }

    private function deleteStoredFiles(array $paths): void
    {
        foreach ($paths as $path) {
            if (empty($path) || !is_string($path)) {
                continue;
            }

            $normalizedPath = ltrim($path, '/');

            if (str_starts_with($normalizedPath, 'storage/')) {
                $normalizedPath = substr($normalizedPath, 8);
            }

            Storage::disk('public')->delete($normalizedPath);
        }
    }

    public function verify($id)
    {
        $user = User::where('role', 'alumni')->findOrFail($id);
        $user->update(['is_verified' => true, 'is_active' => true]);

        return redirect()->back()
            ->with('success', 'Alumni verified successfully');
    }

    public function deactivate($id)
    {
        $user = User::where('role', 'alumni')->findOrFail($id);
        $user->update([
            'is_active' => false,
            'is_verified' => false,
        ]);

        return redirect()->route('admin.alumni-directory.index', ['verified' => 'unverified'])
            ->with('success', 'Alumni declined, unverified, and deactivated');
    }

    public function activate($id)
    {
        $user = User::where('role', 'alumni')->findOrFail($id);
        $user->update(['is_active' => true]);

        return redirect()->back()
            ->with('success', 'Alumni activated successfully');
    }

    private function buildFilteredQuery(Request $request)
    {
        $query = User::with(['alumniProfile.batch'])
            ->where('role', 'alumni');

        // Filter by batch/year
        if ($request->filled('batch')) {
            $query->whereHas('alumniProfile', function ($q) use ($request) {
                $q->where('batch_id', $request->batch);
            });
        }

        // Filter by course
        if ($request->filled('course')) {
            $query->whereHas('alumniProfile', function ($q) use ($request) {
                $q->where(function($subQ) use ($request) {
                    $subQ->where('course', $request->course)
                         ->orWhere('course_graduated', $request->course);
                });
            });
        }

        // Filter by verification status
        if ($request->filled('verified')) {
            if ($request->verified === 'verified') {
                $query->where('is_verified', true)
                      ->where('is_active', true);
            } elseif ($request->verified === 'unverified') {
                $query->where(function ($q) {
                    $q->where('is_verified', false)
                      ->orWhere('is_active', false);
                });
            }
        }

        // Search by name or email
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            });
        }

        return $query;
    }

    /**
     * Get search suggestions for autocomplete
     */
    public function searchSuggestions(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $suggestions = User::where('role', 'alumni')
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%')
                  ->orWhere('email', 'LIKE', '%' . $query . '%');
            })
            ->limit(10)
            ->get(['id', 'name', 'email'])
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'display' => $user->name . ' (' . $user->email . ')'
                ];
            });

        return response()->json($suggestions);
    }
}
