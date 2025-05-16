<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;

class BarangApiController extends Controller
{
    public function index()
    {
        $barangs = Barang::with(['kategori', 'stok'])->get();

        $formatted = $barangs->map(function ($barang) {
            return [
                'id' => $barang->id,
                'nama_barang' => $barang->nama_barang,
                'deskripsi' => $barang->deskripsi,
                'id_kategori' => $barang->id_kategori,
                'kategori' => [
                    'id' => $barang->kategori->id,
                    'nama_kategori' => $barang->kategori->nama_kategori,
                ],
                'jumlah_tersedia' => $barang->stok ? $barang->stok->jumlah : 0,
                'foto' => $barang->foto ? asset('storage/' . $barang->foto) : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $formatted
        ]);
    }
}
