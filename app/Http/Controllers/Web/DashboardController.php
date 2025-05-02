<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Barang;

class DashboardController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('stok')->get();
        $labels = $barangs->pluck('nama_barang');
        $jumlahs = $barangs->map(fn($b) => $b->stok->jumlah ?? 0);

        return view('admin.dashboard', compact('labels', 'jumlahs'));
    }
}

