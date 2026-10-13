<?php

use App\Http\Controllers\Admin\CreditApplicationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SimulationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $motors = App\Models\Motor::with('galleries')->where('is_available', true)->take(6)->get();
    return view('welcome', compact('motors'));
})->name('home');
Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog');
Route::get('/katalog/{id}', [CatalogController::class, 'show'])->name('katalog.show');
Route::get('/simulasi', function () {
    $motors = App\Models\Motor::with('galleries')->where('is_available', true)->get();
    return view('simulasi', compact('motors'));
})->name('simulasi');
Route::view('/pembiayaan', 'pembiayaan')->name('pembiayaan');
Route::view('/asuransi', 'asuransi')->name('asuransi');
Route::view('/bantuan', 'bantuan')->name('bantuan');

// Auth Routes
Route::view('/login', 'pages.auth.login')->name('login');
Route::view('/register', 'pages.auth.register')->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Simulation Routes
Route::post('/simulations', [SimulationController::class, 'store'])->name('simulations.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [SimulationController::class, 'index'])->name('dashboard');
    Route::get('customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('customer/pengajuan', [CustomerController::class, 'pengajuan'])->name('customer.pengajuan');
    Route::delete('customer/pengajuan/{id}', [CustomerController::class, 'destroy'])->name('customer.pengajuan.destroy');
    Route::get('customer/pengaturan', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::get('settings/profile', [CustomerController::class, 'profile'])->name('profile.edit'); // alias for old route
    Route::put('customer/pengaturan/profil', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
    Route::put('customer/pengaturan/password', [CustomerController::class, 'updatePassword'])->name('customer.password.update');
    Route::delete('customer/pengaturan/hapus-akun', [CustomerController::class, 'deleteAccount'])->name('customer.delete');
    Route::get('customer/riwayat-simulasi', function () {
        return view('customer.riwayat-simulasi');
    })->name('customer.riwayat-simulasi');
    Route::get('customer/dokumen', [DocumentController::class, 'index'])->name('customer.dokumen');
    Route::post('customer/dokumen', [DocumentController::class, 'store'])->name('dokumen.store');
    Route::delete('/simulations/{savedSimulation}', [SimulationController::class, 'destroy'])->name('simulations.destroy');
    
    // Pengajuan Routes
    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
});

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        $motors = \App\Models\Motor::with('galleries')->latest()->paginate(10);
        
        // Hitung statistik real
        $totalApplications = \App\Models\Application::count();
        $pendingApplications = \App\Models\Application::where('status', 'pending')->count();
        $soldUnits = \App\Models\Application::where('status', 'completed')->count();
        $availableStock = \App\Models\Motor::where('is_available', true)->count();
        
        // Hitung persentase bulan ini (sederhana: bandingkan bulan ini vs bulan lalu)
        $thisMonth = now()->month;
        $lastMonth = now()->subMonth()->month;
        
        $thisMonthApps = \App\Models\Application::whereMonth('created_at', $thisMonth)->count();
        $lastMonthApps = \App\Models\Application::whereMonth('created_at', $lastMonth)->count();
        $appGrowth = $lastMonthApps > 0 ? round((($thisMonthApps - $lastMonthApps) / $lastMonthApps) * 100, 0) : 0;
        
        $thisMonthSold = \App\Models\Application::where('status', 'completed')->whereMonth('created_at', $thisMonth)->count();
        $lastMonthSold = \App\Models\Application::where('status', 'completed')->whereMonth('created_at', $lastMonth)->count();
        $soldGrowth = $lastMonthSold > 0 ? round((($thisMonthSold - $lastMonthSold) / $lastMonthSold) * 100, 0) : 0;
        
        return view('admin.dashboard', compact('motors', 'totalApplications', 'pendingApplications', 'soldUnits', 'availableStock', 'appGrowth', 'soldGrowth'));
    })->name('dashboard');
    Route::get('applications', [CreditApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{id}', [CreditApplicationController::class, 'show'])->name('applications.show');
    Route::patch('applications/{id}/update-status', [CreditApplicationController::class, 'updateStatus'])->name('applications.update-status');
    Route::post('applications/{id}/approve', [CreditApplicationController::class, 'approve'])->name('applications.approve');
    Route::post('applications/{id}/reject', [CreditApplicationController::class, 'reject'])->name('applications.reject');
    Route::get('motors/create', [\App\Http\Controllers\Admin\MotorController::class, 'create'])->name('motors.create');
    Route::post('motors', [\App\Http\Controllers\Admin\MotorController::class, 'store'])->name('motors.store');
    Route::get('motors/{motor}/edit', [\App\Http\Controllers\Admin\MotorController::class, 'edit'])->name('motors.edit');
    Route::put('motors/{motor}', [\App\Http\Controllers\Admin\MotorController::class, 'update'])->name('motors.update');
    Route::delete('motors/{motor}', [\App\Http\Controllers\Admin\MotorController::class, 'destroy'])->name('motors.destroy');
    Route::delete('motors/{motor}/galleries/{gallery}', [\App\Http\Controllers\Admin\MotorController::class, 'destroyGallery'])->name('motors.galleries.destroy');
    
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/settings.php';
