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

    public function laporanPeminjaman()
    {
        // Get all peminjaman with related data except pending
        $peminjamans = Peminjaman::with(['barang', 'user'])
            ->whereIn('status', ['approved', 'rejected', 'returned'])
            ->orderBy('tanggal_pinjam', 'desc')
            ->get();

        return view('admin.laporan.peminjaman', compact('peminjamans'));
    }

   
    public function laporanPengembalian()
    {
        // Get all pengembalian with related data except pending
        $pengembalians = Pengembalian::with(['peminjaman', 'peminjaman.barang', 'peminjaman.user'])
            ->whereIn('status_pengembalian', ['completed', 'damaged'])
            ->orderBy('tanggal_pengembalian', 'desc')
            ->get();

        return view('admin.laporan.pengembalian', compact('pengembalians'));
    }
}