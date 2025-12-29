<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\Admin\PeminjamanAdminController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// HOME
Route::get('/', function () {
    return view('welcome');
})->name('home');

// AUTH (MANUAL LOGIN)
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

// REGISTER (PAKAI RegisterController BAWAAN)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->middleware('guest');

// LOGOUT (MANUAL)
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home');
})->middleware('auth')->name('logout');

// DASHBOARD + FITUR MAHASISWA
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // MAHASISWA: AJUKAN PINJAM
    Route::post('/pinjam', [PeminjamanController::class, 'store'])->name('pinjam.store');

    // MAHASISWA: KEMBALIKAN
    Route::patch('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])
        ->name('peminjaman.kembalikan');
});

// ADMIN (DIBATASI ADMIN SAJA)
Route::middleware(['auth', 'can:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ADMIN: KELOLA ALAT
        Route::resource('alat', AlatController::class);

        // UPDATE STATUS PEMINJAMAN
        Route::patch('/peminjaman/{id}/status', [PeminjamanAdminController::class, 'updateStatus'])
            ->name('peminjaman.status');
    });
