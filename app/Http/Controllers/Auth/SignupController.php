<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\AlumniProfile;
use App\Models\OTP;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class SignupController extends Controller
{
    /**
     * Step 1: Show signup form for basic info.
     */
    public function showStep1(): View
    {
        return view('auth.signup.step1');
    }

    /**
     * Step 1: Validate and store signup data in session, then send OTP.
     */
    public function submitStep1(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'family_name' => ['required', 'string', 'max:255'],
            'given_name' => ['required', 'string', 'max:255'],
            'middle_initial' => ['nullable', 'string', 'max:10'],
            'suffix' => ['nullable', 'string', 'max:50'],
            'sex' => ['required', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'contact_number' => ['required', 'string', 'max:35'],
            'campus' => ['required', 'string', 'max:255'],
            'course_graduated' => ['required', 'string', 'max:255'],
            'year_graduated' => ['required', 'integer', 'between:1950,' . date('Y')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms_accepted' => ['accepted'],
        ], [
            'terms_accepted.accepted' => 'You must accept the terms and privacy policy.',
        ]);

        // Store in session for step 2
        $request->session()->put('signup_data', [
            'family_name' => $validated['family_name'],
            'given_name' => $validated['given_name'],
            'middle_initial' => $validated['middle_initial'] ?? null,
            'suffix' => $validated['suffix'] ?? null,
            'sex' => $validated['sex'],
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'email' => $validated['email'],
            'contact_number' => $validated['contact_number'] ?? null,
            'campus' => $validated['campus'],
            'course_graduated' => $validated['course_graduated'],
            'year_graduated' => $validated['year_graduated'],
            'password' => $validated['password'],
            'profile_picture' => null,
        ]);

        // Force session save
        $request->session()->save();

        // Create and send OTP via email
        $otp = OTP::createOrUpdateOTP($validated['email']);

        try {
            Mail::to($validated['email'])->send(new OTPMail($otp->otp_code, $validated['given_name']));
        } catch (\Throwable $e) {
            Log::error('OTP email send failed: ' . $e->getMessage(), ['exception' => $e]);
            $otp->delete();
            return back()->with('error', 'Unable to send OTP at the moment. Please try again.');
        }

        if (config('app.debug')) {
            session()->flash('otp_debug', "OTP for testing: {$otp->otp_code}");
        }

        return redirect()->route('signup.step2');
    }

    /**
     * Step 2: Show OTP verification form
     */
    public function showStep2(): View|RedirectResponse
    {
        if (!session()->has('signup_data')) {
            return redirect()->route('signup.step1')->with('error', 'Please complete step 1 first');
        }

        $email = session('signup_data.email');
        return view('auth.signup.step2', compact('email'));
    }

    /**
     * Step 2: Verify OTP
     */
    public function submitStep2(Request $request): RedirectResponse
    {
        $request->validate([
            'otp_code' => ['required', 'string', 'size:6', 'regex:/^\d{6}$/'],
        ], [
            'otp_code.size' => 'OTP must be 6 digits',
            'otp_code.regex' => 'OTP must contain only numbers',
        ]);

        if (!session()->has('signup_data')) {
            return redirect()->route('signup.step1')->with('error', 'Session expired. Please start over.');
        }

        $email = session('signup_data.email');
        $otp = OTP::where('email', $email)->first();

        if (!$otp) {
            Log::warning('OTP not found for email: ' . $email);
            return back()->with('error', 'OTP not found. Please try again.');
        }

        if ($otp->isExpired()) {
            Log::info('OTP expired for email: ' . $email);
            $otp->delete();
            session()->forget('signup_data');
            return redirect()->route('signup.step1')->with('error', 'OTP has expired. Please start over.');
        }

        if ($otp->hasExceededAttempts()) {
            Log::warning('Max attempts exceeded for email: ' . $email);
            $otp->delete();
            session()->forget('signup_data');
            return redirect()->route('signup.step1')->with('error', 'Maximum attempts exceeded. Please try again.');
        }

        $inputOtp = trim($request->otp_code);
        $storedOtp = trim($otp->otp_code);

        if ($storedOtp !== $inputOtp) {
            Log::warning('Invalid OTP attempt for email: ' . $email . ' (input: ' . $inputOtp . ', stored: ' . $storedOtp . ')');
            $otp->incrementAttempts();
            $remaining = 3 - $otp->attempts;
            return back()->with('error', "Invalid OTP. {$remaining} attempt(s) remaining.");
        }

        $otp->markAsVerified();

        return redirect()->route('signup.complete');
    }

    /**
     * Complete signup: Create user account
     */
    public function complete(Request $request): RedirectResponse
    {
        $signupData = session('signup_data');

        if (!$signupData) {
            return redirect()->route('signup.step1')->with('error', 'Session expired. Please start over.');
        }

        $otp = OTP::where('email', $signupData['email'])
            ->where('is_verified', true)
            ->first();

        if (!$otp) {
            return redirect()->route('signup.step2')->with('error', 'Please verify OTP first.');
        }

        try {
            $fullName = $signupData['family_name'] . ', ' . $signupData['given_name']
                . ($signupData['middle_initial'] ? ' ' . $signupData['middle_initial'] : '')
                . ($signupData['suffix'] ? ' ' . $signupData['suffix'] : '');

            $user = User::create([
                'name' => $fullName,
                'email' => $signupData['email'],
                'contact_number' => $signupData['contact_number'],
                'password' => Hash::make($signupData['password']),
                'role' => 'alumni',
            ]);

            AlumniProfile::create([
                'user_id' => $user->id,
                'family_name' => $signupData['family_name'],
                'given_name' => $signupData['given_name'],
                'middle_initial' => $signupData['middle_initial'] ?? null,
                'suffix' => $signupData['suffix'] ?? null,
                'sex' => $signupData['sex'],
                'date_of_birth' => $signupData['date_of_birth'] ?? null,
                'phone' => $signupData['contact_number'],
                'campus' => $signupData['campus'],
                'course_graduated' => $signupData['course_graduated'],
                'year_graduated' => $signupData['year_graduated'],
                'course' => $signupData['course_graduated'],
                'batch_id' => $this->getBatchByYear($signupData['year_graduated']),
                'profile_picture' => $signupData['profile_picture'] ?? null,
            ]);

            $otp->delete();
            session()->forget('signup_data');

            event(new Registered($user));
            Auth::login($user);

            $message = 'Account created successfully! Your account is pending verification.';

            return redirect(route('alumni.dashboard'))->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Signup completion error: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'An error occurred while creating your account. Please try again. Error: ' . $e->getMessage());
        }
    }

    /**
     * Get or create batch by year
     */
    private function getBatchByYear(int $year): ?int
    {
        $batch = \App\Models\Batch::firstOrCreate(
            ['year' => $year],
            ['description' => "Batch of {$year}"]
        );

        return $batch->id;
    }

    /**
     * Resend OTP
     */
    public function resendOTP(Request $request): RedirectResponse
    {
        $email = session('signup_data.email');

        if (!$email) {
            return redirect()->route('signup.step1')->with('error', 'Session expired. Please start over.');
        }

        $otp = OTP::createOrUpdateOTP($email);

        try {
            Mail::to($email)->send(new OTPMail($otp->otp_code, session('signup_data.given_name', 'User')));
        } catch (\Throwable $e) {
            Log::error('OTP email resend failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Unable to resend OTP at the moment. Please try again.');
        }

        if (config('app.debug')) {
            session()->flash('otp_debug', "OTP for testing: {$otp->otp_code}");
        }

        return back()->with('success', 'OTP has been resent to your email address.');
    }

    /**
     * Send OTP via Twilio SMS
     */
    private function sendOtpSms(string $phone, string $otpCode): void
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.from');

        if (!$sid || !$token) {
            if (config('app.debug')) {
                Log::warning("OTP Development Mode - Phone: {$phone}, OTP: {$otpCode}");
                return;
            }

            throw new \RuntimeException('Twilio credentials are not configured.');
        }

        $to = $this->normalizePhoneNumber($phone);
        $message = "Your OTP is {$otpCode}. It expires in 10 minutes.";

        $client = new Client([
            'base_uri' => 'https://api.twilio.com/2010-04-01/',
            'timeout' => 10,
        ]);

        $client->post("Accounts/{$sid}/Messages.json", [
            'auth' => [$sid, $token],
            'form_params' => [
                'From' => $from,
                'To' => $to,
                'Body' => $message,
            ],
        ]);
    }

    /**
     * Normalize phone number to E.164 format
     */
    private function normalizePhoneNumber(string $phone): string
    {
        $digits = preg_replace('/\D+/', '', $phone);

        if (str_starts_with($phone, '+')) {
            return '+' . $digits;
        }

        $defaultCode = config('services.twilio.default_country_code');
        if (!$defaultCode) {
            throw new \RuntimeException('Default country code is not configured for non-E.164 numbers.');
        }

        return $defaultCode . ltrim($digits, '0');
    }
}