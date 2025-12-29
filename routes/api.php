<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlatApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sini Anda mendaftarkan rute API untuk aplikasi. Rute-rute ini
| dimuat oleh RouteServiceProvider dan semuanya akan diberi grup
| middleware "api".
|
*/

// Mendapatkan data user yang login (Bawaan Laravel Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Publik untuk Daftar Alat (Tubes Nilai Maksimal)
Route::prefix('v1')->group(function () {
    // URL: http://127.0.0.1:8000/api/v1/alats
    Route::get('/alats', [AlatApiController::class, 'index']);

    // URL: http://127.0.0.1:8000/api/v1/alats/{id}
    Route::get('/alats/{id}', [AlatApiController::class, 'show']);
});
