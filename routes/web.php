<?php

use App\Http\Controllers\Web\PengembalianController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\BarangController;
use App\Http\Controllers\Web\KategoriController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\PeminjamanController;
use App\Http\Controllers\Web\StokBarangController;


// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Group (wajib is_admin)
Route::middleware(['is_admin'])->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Reports
    Route::get('/admin/laporan/peminjaman', [DashboardController::class, 'laporanPeminjaman'])->name('admin.laporan.peminjaman');
    Route::get('/admin/laporan/pengembalian', [DashboardController::class, 'laporanPengembalian'])->name('admin.laporan.pengembalian');


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

    Route::prefix('admin/stok')->group(function () {
        Route::get('/', [StokBarangController::class, 'index'])->name('admin.stok.index');
        Route::get('/create', [StokBarangController::class, 'create'])->name('admin.stok.create');
        Route::post('/store', [StokBarangController::class, 'store'])->name('stok.store');
        Route::get('/edit/{id}', [StokBarangController::class, 'edit'])->name('admin.stok.edit');
        Route::put('/update/{id}', [StokBarangController::class, 'update'])->name('stok.update');
        Route::delete('/destroy/{id}', [StokBarangController::class, 'destroy'])->name('stok.destroy');
    });


    Route::prefix('admin/peminjaman')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index'])->name('admin.peminjaman.index');
        Route::get('/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
        Route::post('/approve/{id}', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
        Route::post('/reject/{id}', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
        Route::post('/return/{id}', [PeminjamanController::class, 'return'])->name('peminjaman.return');
});


    Route::prefix('admin/pengembalian')->group(function () {
        Route::get('/', [PengembalianController::class, 'index'])->name('admin.pengembalian.index');
        Route::get('/{id}', [PengembalianController::class, 'show'])->name('admin.pengembalian.show');
        Route::post('/approve/{id}', [PengembalianController::class, 'approve'])->name('pengembalian.approve');
        Route::post('/reject/{id}', [PengembalianController::class, 'reject'])->name('pengembalian.reject');
        Route::get('/damaged/{id}', [PengembalianController::class, 'markDamaged'])->name('admin.pengembalian.mark_damaged');
        Route::put('/damaged/{id}', [PengembalianController::class, 'updateDamaged'])->name('pengembalian.update_damaged');
});



});

