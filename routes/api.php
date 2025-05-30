<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\API\PeminjamanController;
use App\Http\Controllers\API\KategoriApiController;
use App\Http\Controllers\Api\PengembalianController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });     

    
});     

Route::prefix('v1')->group(function () {
    Route::get('/barangs', [BarangApiController::class, 'index']);
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);
    Route::post('/pengembalian', [PengembalianController::class, 'store']);
});


