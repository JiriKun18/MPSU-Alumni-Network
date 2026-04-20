<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Batch;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlumniDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'alumni') {
                return redirect('/')->with('error', 'Unauthorized access');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $user = Auth::user();
        $profile = $user->alumniProfile;

        return view('alumni.dashboard', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $profile = $user->alumniProfile;

        return view('alumni.profile-show', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    public function editProfile()
    {
        $user = Auth::user();
        $profile = $user->alumniProfile;

        return view('alumni.profile', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'current_position' => 'nullable|string|max:255',
            'current_company' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'present_country' => 'nullable|string|max:255',
            'present_region' => 'nullable|string|max:255',
            'present_province' => 'nullable|string|max:255',
            'present_city' => 'nullable|string|max:255',
            'present_barangay' => 'nullable|string|max:255',
            'present_address' => 'nullable|string|max:500',
            'present_postal_code' => 'nullable|string|max:20',
            'same_as_present' => 'nullable|string|max:10',
            'permanent_country' => 'nullable|string|max:255',
            'permanent_region' => 'nullable|string|max:255',
            'permanent_province' => 'nullable|string|max:255',
            'permanent_city' => 'nullable|string|max:255',
            'permanent_barangay' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:500',
            'permanent_postal_code' => 'nullable|string|max:20',
            'course' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'profile_picture' => 'nullable|file|max:2048',
            'remove_profile_picture' => 'nullable|boolean',
            'proof_of_employment' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:5120',
            // Privacy settings
            'show_email' => 'nullable|boolean',
            'show_phone' => 'nullable|boolean',
            'show_birthdate' => 'nullable|boolean',
            'show_present_address' => 'nullable|boolean',
            'show_permanent_address' => 'nullable|boolean',
            'show_occupation' => 'nullable|boolean',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $profile = $user->alumniProfile;
        if (!$profile) {
            $profile = new AlumniProfile(['user_id' => $user->id]);
        }

        $data = $request->except(['profile_picture', 'remove_profile_picture']);
        
        // Handle privacy settings (checkboxes return 1 or null)
        $data['show_email'] = $request->has('show_email') ? 1 : 0;
        $data['show_phone'] = $request->has('show_phone') ? 1 : 0;
        $data['show_birthdate'] = $request->has('show_birthdate') ? 1 : 0;
        $data['show_present_address'] = $request->has('show_present_address') ? 1 : 0;
        $data['show_permanent_address'] = $request->has('show_permanent_address') ? 1 : 0;
        $data['show_occupation'] = $request->has('show_occupation') ? 1 : 0;

        if (($data['same_as_present'] ?? null) === 'yes') {
            $data['permanent_country'] = $data['present_country'] ?? null;
            $data['permanent_region'] = $data['present_region'] ?? null;
            $data['permanent_province'] = $data['present_province'] ?? null;
            $data['permanent_city'] = $data['present_city'] ?? null;
            $data['permanent_barangay'] = $data['present_barangay'] ?? null;
            $data['permanent_address'] = $data['present_address'] ?? null;
            $data['permanent_postal_code'] = $data['present_postal_code'] ?? null;
        }

        if ($request->hasFile('profile_picture')) {
            if (!empty($profile->profile_picture)) {
                Storage::disk('public')->delete($profile->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $data['profile_picture'] = $path;
        } elseif ($request->boolean('remove_profile_picture')) {
            if (!empty($profile->profile_picture)) {
                Storage::disk('public')->delete($profile->profile_picture);
            }
            $data['profile_picture'] = null;
        }

        if ($request->hasFile('proof_of_employment')) {
            if (!empty($profile->proof_of_employment)) {
                Storage::disk('public')->delete($profile->proof_of_employment);
            }
            $path = $request->file('proof_of_employment')->store('proof-of-employment', 'public');
            $data['proof_of_employment'] = $path;
        }

        $profile->fill($data);
        $profile->save();

        // Keep users.name aligned with the formatted name shown across directory/profile pages.
        $displayFullName = trim(preg_replace('/\s+/', ' ', sprintf(
            '%s, %s %s %s',
            $profile->family_name ?? '',
            $profile->given_name ?? '',
            $profile->middle_initial ?? '',
            $profile->suffix ?? ''
        )));
        
        if ($displayFullName) {
            $user->update(['name' => $displayFullName]);
        }

        // Refresh the authenticated user to update session
        $user->refresh();
        Auth::setUser($user);

        return redirect()->route('alumni.profile')->with('success', 'Profile updated successfully');
    }

    /**
     * Delete proof of employment
     */
    public function deleteProofOfEmployment()
    {
        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $profile = $user->alumniProfile;

            if ($profile && $profile->proof_of_employment) {
                $documentPath = ltrim((string) $profile->proof_of_employment, '/');

                // Support both "proof-of-employment/file.jpg" and legacy "storage/proof-of-employment/file.jpg" values.
                if (str_starts_with($documentPath, 'storage/')) {
                    $documentPath = substr($documentPath, 8);
                }

                // Delete the file from storage if it still exists.
                Storage::disk('public')->delete($documentPath);

                // Persist deletion using direct assignment to avoid mass-assignment restrictions.
                $profile->proof_of_employment = null;
                $profile->save();

                return redirect()->back()
                    ->with('success', 'Proof of employment document deleted successfully');
            }

            return redirect()->back()
                ->with('error', 'No proof of employment document found to delete');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete proof of employment: ' . $e->getMessage());
        }
    }

    public function directory()
    {
        $search = request('search');
        $batch = request('batch');

        $query = AlumniProfile::with(['user', 'batch'])
            ->whereHas('user', function ($userQ) {
                $userQ->where('is_verified', true)
                    ->where('is_active', true);
            });

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('family_name', 'like', "%{$search}%")
                  ->orWhere('given_name', 'like', "%{$search}%")
                  ->orWhere('current_company', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQ) use ($search) {
                      $userQ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($batch) {
            $query->where('batch_id', $batch);
        }

        $alumni = $query->paginate(12);
        $batches = Batch::orderBy('year', 'desc')->get();
        $courses = AlumniProfile::select('course')
            ->distinct()
            ->whereNotNull('course')
            ->orderBy('course')
            ->pluck('course');

        return view('alumni.directory', compact('alumni', 'batches', 'courses', 'search', 'batch'));
    }

    public function viewProfile($id)
    {
        if (Auth::user() && !Auth::user()->is_verified) {
            return view('alumni.view-profile', [
                'profile' => null,
                'verificationRequired' => true,
            ]);
        }

        $profile = AlumniProfile::where('user_id', $id)
            ->with('batch')
            ->firstOrFail();

        return view('alumni.view-profile', [
            'profile' => $profile,
            'verificationRequired' => false,
        ]);
    }
}
