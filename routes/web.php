<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\BarangController;
use App\Http\Controllers\Web\KategoriController;


// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Group (wajib is_admin)
Route::middleware(['is_admin'])->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Barang CRUD
    Route::prefix('admin/barang')->group(function () {
        Route::get('/', [BarangController::class, 'index'])->name('admin.barang.index');
        Route::get('/create', [BarangController::class, 'create'])->name('admin.barang.create');
        Route::post('/store', [BarangController::class, 'store'])->name('barang.store');
        Route::get('/edit/{id}', [BarangController::class, 'edit'])->name('admin.barang.edit');
        Route::put('/update/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/destroy/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    });

    // Kategori CRUD
    Route::prefix('admin/kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('admin.kategori.index');
        Route::get('/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
        Route::post('/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/edit/{id}', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
        Route::put('/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });

});

