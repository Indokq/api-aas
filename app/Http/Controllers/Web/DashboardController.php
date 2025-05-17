<?php

namespace App\Http\Controllers\Web;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\stokBarang;
use App\Models\Pengembalian;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Data stok dan pinjam (sudah ada)
        $stoks = StokBarang::with('barang')->get();
        $labels = $stoks->map(fn($s) => $s->barang->nama_barang)->toArray();
        $jumlahs = $stoks->pluck('jumlah')->toArray();
        $totalBarang = $stoks->sum('jumlah');
        $totalDipinjam = Peminjaman::sum('jumlah');

        // Tambah total pengembalian
        $totalPengembalian = Pengembalian::count(); // asumsi kolom jumlah ada

        return view('admin.dashboard', compact('labels', 'jumlahs', 'totalBarang', 'totalDipinjam', 'totalPengembalian'));
    }

    /**
     * Display a report of approved peminjaman.
     */
    public function laporanPeminjaman()
    {
        // Get all approved peminjaman with related data
        $peminjamans = Peminjaman::with(['barang', 'user'])
            ->where('status', 'approved')
            ->orderBy('tanggal_pinjam', 'desc')
            ->get();

        return view('admin.laporan.peminjaman', compact('peminjamans'));
    }

    /**
     * Display a report of successful pengembalian.
     */
    public function laporanPengembalian()
    {
        // Get all completed pengembalian with related data
        $pengembalians = Pengembalian::with(['peminjaman', 'peminjaman.barang', 'peminjaman.user'])
            ->where('status_pengembalian', 'completed')
            ->orderBy('tanggal_pengembalian', 'desc')
            ->get();

        return view('admin.laporan.pengembalian', compact('pengembalians'));
    }
}