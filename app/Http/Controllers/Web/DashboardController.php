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



}