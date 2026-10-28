<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentDashboardController; 
use App\Http\Controllers\InstructorDashboardController; // <--- Idinagdag natin ito
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminApplicationController;
use App\Http\Controllers\WeatherController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Models\Subject;

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin Application Routes
Route::get('/apply-admin', [AdminApplicationController::class, 'create'])->name('admin.apply');
Route::post('/apply-admin', [AdminApplicationController::class, 'store'])->name('admin.apply.submit');

/*
|--------------------------------------------------------------------------
| Role-Specific Login Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', function () {
    return view('auth.login', ['role' => 'admin']);
})->name('admin.login');

Route::get('/instructor/login', function () {
    return view('auth.login', ['role' => 'instructor']);
})->name('instructor.login');

Route::get('/student/login', function () {
    return view('auth.login', ['role' => 'student']);
})->name('student.login');


/*
|--------------------------------------------------------------------------
| Generic Redirect Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'instructor') {
        return redirect()->route('instructor.dashboard');
    }
    return redirect()->route('student.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| 1. ADMIN ROUTES (Prefix: /admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

    // User Management CRUD
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Admin Applications Review
    Route::get('/applications', [AdminApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [AdminApplicationController::class, 'show'])->name('applications.show');
    
    Route::match(['post', 'patch'], '/applications/{application}/approve', [AdminApplicationController::class, 'approve'])->name('applications.approve');
    Route::match(['post', 'patch'], '/applications/{application}/reject', [AdminApplicationController::class, 'reject'])->name('applications.reject');

    // CRUD Resource Routes
    Route::resource('subjects', SubjectController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('schedules', ScheduleController::class);
});


/*
|--------------------------------------------------------------------------
| 2. INSTRUCTOR ROUTES (Prefix: /instructor)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':instructor'])->prefix('instructor')->name('instructor.')->group(function () {
    // Ginamit na natin ang InstructorDashboardController
    Route::get('/dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');
    
    // Instructor Print Schedule Matrix
    Route::get('/print-schedule', function () {
        $instructorSubjects = Subject::with(['schedule.room', 'schedule.instructor'])->get();
        return view('instructor.print.schedule', [
            'subjects' => $instructorSubjects
        ]);
    })->name('print.schedule');
});


/*
|--------------------------------------------------------------------------
| 3. STUDENT ROUTES (Prefix: /student)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':student'])->prefix('student')->name('student.')->group(function () {
    // Student Dashboard
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    
    // Print Schedule Matrix View para sa Student
    Route::get('/print-schedule', function () {
        $user = auth()->user();
        $subjects = Subject::with(['schedule.room', 'schedule.instructor'])->get();
        
        return view('student.print.schedule', [
            'subjects' => $subjects,
            'studentYear' => '3rd',
            'studentSection' => '3A'
        ]);
    })->name('print.schedule');
});


/*
|--------------------------------------------------------------------------
| Shared Authenticated API / Weather Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/api/weather', [WeatherController::class, 'getWeather'])->name('weather.get');
    Route::get('/api/weather/search', [WeatherController::class, 'searchLocations'])->name('weather.search');
});


/*
|--------------------------------------------------------------------------
| User Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';