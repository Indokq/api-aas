<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Barang;

class PengembalianController extends Controller
{
    public function store(Request $request)
    {
        // Validasi user, hanya bisa membuat pengembalian untuk peminjaman miliknya sendiri
        if (!$request->user()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. User not authenticated.'
            ], 401);
        }

        // Ambil user_id dari user yang sedang login
        $userId = $request->user()->id;

        $validated = $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'tanggal_pengembalian' => 'required|date',
            'jumlah_dikembalikan' => 'required|integer|min:1',
            'status_pengembalian' => 'required|in:pending,completed,damaged',
            'keterangan' => 'nullable|string',
            'denda' => 'nullable|numeric|min:0',
        ]);

        // Cari peminjaman dan pastikan milik user yang sedang login
        $peminjaman = Peminjaman::with('barang.stok')->findOrFail($validated['peminjaman_id']);

        // Validasi bahwa peminjaman ini milik user yang sedang login
        if ($peminjaman->user_id !== $userId) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. You can only return your own borrowed items.'
            ], 403);
        }

        if ($peminjaman->status === 'returned') {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman ini sudah ditandai sebagai dikembalikan.'
            ], 400);
        }

        $pengembalian = Pengembalian::create($validated);

        // Update status peminjaman ke 'returned'
        $peminjaman->update(['status' => 'returned']);

        // Tambah stok barang kembali
        if ($peminjaman->barang && $peminjaman->barang->stok) {
            $peminjaman->barang->stok->increment('jumlah', $validated['jumlah_dikembalikan']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pengembalian berhasil disimpan.',
            'data' => $pengembalian
        ], 201);
    }
}
