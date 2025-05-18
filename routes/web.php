<?php

use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\{
    DashboardController,
    UserController,
    LoanAdminController,
    ActivityController
};

// Redirect default ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute Autentikasi (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout (Auth)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rute Pengguna Biasa (Auth)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('loans', LoanController::class);
});

// ===========================
// RUTE ADMIN (TANPA MIDDLEWARE)
// ===========================
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Manajemen User (CRUD Lengkap)
    Route::resource('users', UserController::class)->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    
    // Manajemen Pinjaman (CRUD Lengkap)
    Route::resource('loans', LoanAdminController::class)->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    
    // Aktivitas Sistem
    Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');
});

