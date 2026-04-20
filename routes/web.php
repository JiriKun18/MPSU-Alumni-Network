
<?php



use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\AlumniDashboardController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\JobManagementController;
use App\Http\Controllers\Admin\EventManagementController;
use App\Http\Controllers\Admin\NewsManagementController;
use App\Http\Controllers\Admin\SurveyManagementController as AdminSurveyController;
use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SurveyResponseController;

// Debug routes (development only)
if (config('app.debug')) {
    require __DIR__ . '/debug.php';
}

// Guest routes

// Survey response route
Route::post('/survey/response', [SurveyResponseController::class, 'store'])->middleware('auth')->name('survey.response.store');
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

    // Legacy register URL -> new signup flow
    Route::get('/register', function () {
        return redirect()->route('signup.step1');
    })->name('register');
    Route::post('/register', function () {
        return redirect()->route('signup.step1');
    })->name('register.store');

    // New signup flow (step-by-step)
    Route::prefix('signup')->name('signup.')->group(function () {
        Route::get('/step1', [SignupController::class, 'showStep1'])->name('step1');
        Route::post('/step1', [SignupController::class, 'submitStep1'])->name('step1.submit');
        Route::get('/step2', [SignupController::class, 'showStep2'])->name('step2');
        Route::post('/step2', [SignupController::class, 'submitStep2'])->name('step2.submit');
        Route::post('/resend-otp', [SignupController::class, 'resendOTP'])->name('resend-otp');
    });
    
    Route::get('/signup/complete', [SignupController::class, 'complete'])->name('signup.complete');
});

// Admin Login Routes (public but restricted)
Route::middleware('guest')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showAdminLogin'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'handleAdminLogin'])->name('login.store');
});

// Logout route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/jobs', [JobPostingController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobPostingController::class, 'create'])->name('jobs.create');
Route::post('/jobs', [JobPostingController::class, 'store'])->name('jobs.store');
Route::get('/jobs/{id}', [JobPostingController::class, 'show'])->name('jobs.show');


Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/upcoming', [EventController::class, 'upcoming'])->name('events.upcoming');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

// Legal pages
Route::get('/privacy-policy', function () {
    return view('legal.privacy-policy');
})->name('privacy-policy');

Route::get('/terms-of-service', function () {
    return view('legal.terms-of-service');
})->name('terms-of-service');

// Survey routes (for alumni)
Route::middleware(['auth'])->group(function () {
    Route::get('/surveys', [SurveyController::class, 'index'])->name('surveys.index');
    Route::get('/surveys/{survey}', [SurveyController::class, 'show'])->name('surveys.show');
    Route::post('/surveys/{survey}', [SurveyController::class, 'store'])->name('surveys.store');
    Route::get('/surveys/{survey}/edit', [SurveyController::class, 'edit'])->name('surveys.edit');
    Route::put('/surveys/{survey}', [SurveyController::class, 'update'])->name('surveys.update');
    Route::delete('/surveys/{survey}', [SurveyController::class, 'destroy'])->name('surveys.destroy');
});

// Alumni Directory (public for alumni)
Route::middleware(['auth'])->group(function () {
    Route::get('/alumni-directory', [App\Http\Controllers\AlumniDirectoryController::class, 'index'])->name('alumni.directory');
    Route::get('/alumni-directory/{id}', [App\Http\Controllers\AlumniDirectoryController::class, 'show'])->name('alumni.directory.show');
});

// Alumni routes
Route::middleware(['auth'])->prefix('alumni')->name('alumni.')->group(function () {
    Route::get('/profile', [AlumniDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [AlumniDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/profile/edit', [AlumniDashboardController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/delete-proof-of-employment', [AlumniDashboardController::class, 'deleteProofOfEmployment'])->name('deleteProofOfEmployment');
    Route::get('/dashboard', [AlumniDashboardController::class, 'index'])->name('dashboard');
    Route::get('/directory', [AlumniDashboardController::class, 'directory'])->name('alumni-dir');
    Route::get('/profile/{id}', [AlumniDashboardController::class, 'viewProfile'])->name('view-profile');
    Route::get('/about', function () {
        return view('alumni.about');
    })->name('about');
});

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Alumni management (directory)
    Route::prefix('alumni-directory')->name('alumni-directory.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AlumniDirectoryController::class, 'index'])->name('index');
        Route::get('/search-suggestions', [App\Http\Controllers\Admin\AlumniDirectoryController::class, 'searchSuggestions'])->name('search-suggestions');
        Route::get('/print', [App\Http\Controllers\Admin\AlumniDirectoryController::class, 'print'])->name('print');
        Route::get('/export', [App\Http\Controllers\Admin\AlumniDirectoryController::class, 'export'])->name('export');
        Route::get('/{id}', [App\Http\Controllers\Admin\AlumniDirectoryController::class, 'show'])->name('show');
        Route::post('/{id}/verify', [App\Http\Controllers\Admin\AlumniDirectoryController::class, 'verify'])->name('verify');
        Route::post('/{id}/deactivate', [App\Http\Controllers\Admin\AlumniDirectoryController::class, 'deactivate'])->name('deactivate');
        Route::post('/{id}/activate', [App\Http\Controllers\Admin\AlumniDirectoryController::class, 'activate'])->name('activate');
        Route::delete('/{id}', [App\Http\Controllers\Admin\AlumniDirectoryController::class, 'destroy'])->name('destroy');
    });

    // Job management
    Route::prefix('jobs')->name('jobs.')->group(function () {
        Route::get('/', [JobManagementController::class, 'index'])->name('index');
        Route::get('/create', [JobManagementController::class, 'create'])->name('create');
        Route::post('/', [JobManagementController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [JobManagementController::class, 'edit'])->name('edit');
        Route::get('/{id}/review', [JobManagementController::class, 'review'])->name('review');
        Route::put('/{id}', [JobManagementController::class, 'update'])->name('update');
        Route::post('/{id}/approve', [JobManagementController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [JobManagementController::class, 'reject'])->name('reject');
        Route::post('/{id}/disable', [JobManagementController::class, 'disable'])->name('disable');
        Route::delete('/{id}', [JobManagementController::class, 'delete'])->name('delete');

    });

    // Event management
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [EventManagementController::class, 'index'])->name('index');
        Route::get('/create', [EventManagementController::class, 'create'])->name('create');
        Route::post('/', [EventManagementController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [EventManagementController::class, 'edit'])->name('edit');
        Route::put('/{id}', [EventManagementController::class, 'update'])->name('update');
        Route::delete('/{id}', [EventManagementController::class, 'delete'])->name('delete');

    });

    // News management
    Route::prefix('news')->name('news.')->group(function () {
        Route::get('/', [NewsManagementController::class, 'index'])->name('index');
        Route::get('/create', [NewsManagementController::class, 'create'])->name('create');
        Route::post('/', [NewsManagementController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [NewsManagementController::class, 'edit'])->name('edit');
        Route::put('/{id}', [NewsManagementController::class, 'update'])->name('update');
        Route::delete('/{id}', [NewsManagementController::class, 'delete'])->name('delete');
    });

    // Surveys management
    Route::prefix('surveys')->name('surveys.')->group(function () {
        Route::get('/', [AdminSurveyController::class, 'index'])->name('index');
        Route::get('/create', [AdminSurveyController::class, 'create'])->name('create');
        Route::post('/', [AdminSurveyController::class, 'store'])->name('store');
        Route::get('/{survey}/results', [AdminSurveyController::class, 'results'])->name('results');
    });

    // Database Backups
    Route::prefix('backups')->name('backups.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\BackupController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\BackupController::class, 'create'])->name('create');
        Route::get('/download/{filename}', [App\Http\Controllers\Admin\BackupController::class, 'download'])->name('download');
        Route::delete('/delete/{filename}', [App\Http\Controllers\Admin\BackupController::class, 'delete'])->name('delete');
    });

    // Alumni Directory (admin with full details)

});
