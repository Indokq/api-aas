<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Barang;

class PengembalianController extends Controller
{
    public function index()
    {
        // Ambil data pengembalian
        $pengembalians = Pengembalian::with(['peminjaman', 'peminjaman.barang'])->get();

        return view('admin.pengembalian.index', compact('pengembalians'));
    }


    public function approve($id)
    {
        // Cari pengembalian berdasarkan id
        $pengembalian = Pengembalian::findOrFail($id);
        
        // Cek apakah status pengembalian sudah 'completed' sebelumnya
        if ($pengembalian->status_pengembalian === 'completed') {
            return redirect()->route('admin.pengembalian.index')->with('error', 'Pengembalian ini sudah diselesaikan.');
        }

        // Update status pengembalian jadi 'completed'
        $pengembalian->update([
            'status_pengembalian' => 'completed',
        ]);

        // Update status peminjaman menjadi 'returned'
        $peminjaman = $pengembalian->peminjaman;
        $peminjaman->update(['status' => 'returned']);

        // Update stok barang (kembalikan barang ke stok)
        $barang = $peminjaman->barang;
        if ($barang) {
            $barang->stok->increment('jumlah', $pengembalian->jumlah_dikembalikan);
        }

        return redirect()->route('admin.pengembalian.index')->with('success', 'Pengembalian berhasil diselesaikan.');
    }

    public function reject($id)
    {
        // Cari pengembalian berdasarkan id
        $pengembalian = Pengembalian::findOrFail($id);

        // Update status pengembalian jadi 'damaged'
        $pengembalian->update([
            'status_pengembalian' => 'damaged',
        ]);

        // Update status peminjaman menjadi 'rejected'
        $peminjaman = $pengembalian->peminjaman;
        $peminjaman->update(['status' => 'rejected']);

        // Update stok barang jika rusak (jumlah dikurangi)
        $barang = $pengembalian->peminjaman->barang;
        if ($barang) {
            $barang->stok->decrement('jumlah', $pengembalian->jumlah_dikembalikan);
        }

        return redirect()->route('admin.pengembalian.index')->with('success', 'Pengembalian barang rusak berhasil ditandai.');
    }

    public function markDamaged($id)
    {
        // Cari pengembalian berdasarkan id
        $pengembalian = Pengembalian::findOrFail($id);

        // Tampilkan form untuk memasukkan denda
        return view('admin.pengembalian.mark_damaged', compact('pengembalian'));
    }

    public function updateDamaged(Request $request, $id)
    {
        // Validasi input denda
        $validated = $request->validate([
            'denda' => 'required|numeric|min:0',
        ]);

        // Cari pengembalian berdasarkan id
        $pengembalian = Pengembalian::findOrFail($id);

        // Update status pengembalian jadi 'damaged' dan set denda
        $pengembalian->update([
            'status_pengembalian' => 'damaged',
            'denda' => $validated['denda'],
        ]);

        // Update status peminjaman menjadi 'rejected'
        $peminjaman = $pengembalian->peminjaman;
        $peminjaman->update(['status' => 'rejected']);

        // Update stok barang jika rusak (jumlah dikurangi)
        $barang = $pengembalian->peminjaman->barang;
        if ($barang) {
            $barang->stok->decrement('jumlah', $pengembalian->jumlah_dikembalikan);
        }

        return redirect()->route('admin.pengembalian.index')->with('success', 'Pengembalian barang rusak berhasil ditandai dan denda diperbarui.');
    }
}
