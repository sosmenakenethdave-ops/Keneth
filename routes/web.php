<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminApplicationController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin Application Routes (Public submission of requirements)
Route::get('/apply-admin', [AdminApplicationController::class, 'create'])->name('admin.apply');
Route::post('/apply-admin', [AdminApplicationController::class, 'store'])->name('admin.apply.submit');


/*
|--------------------------------------------------------------------------
| Generic Redirect Dashboard
|--------------------------------------------------------------------------
| Dito pupunta ang user pagka-login at i-reredirect batay sa kanyang role
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
    // Admin Dashboard (May Weather API / Analytics logic)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management CRUD
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Admin Applications Review (Reviewing submitted requirements)
    Route::get('/applications', [AdminApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [AdminApplicationController::class, 'show'])->name('applications.show');
    
    // In-update mula Route::post patungong Route::match(['post', 'patch']) para suportahan ang parehong HTTP verbs
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| 3. STUDENT ROUTES (Prefix: /student)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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