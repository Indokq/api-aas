<?php

namespace App\Http\Controllers\Web;

use App\Models\StokBarang;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StokBarangController extends Controller
{
    public function index()
    {
        $stoks = StokBarang::with('barang')->get();
        return view('admin.stok.index', compact('stoks'));
    }

    public function create()
    {
        $barangs = Barang::doesntHave('stok')->get(); // Biar barang yang udah ada stok nggak muncul lagi
        return view('admin.stok.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id|unique:stok_barangs,id_barang',
            'jumlah' => 'required|integer|min:0',
        ]);

        StokBarang::create($request->only('id_barang', 'jumlah'));

        return redirect()->route('admin.stok.index')->with('success', 'Stok berhasil ditambahkan.');
    }

    public function edit($id)
    {
    $stok = StokBarang::with('barang')->findOrFail($id);
    $barangs = Barang::all(); // atau Barang::doesntHave('stok') kalau mau batasi
    return view('admin.stok.edit', compact('stok', 'barangs'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:0',
        ]);

        $stok = StokBarang::findOrFail($id);
        $stok->update(['jumlah' => $request->jumlah]);

        return redirect()->route('admin.stok.index')->with('success', 'Stok berhasil diupdate.');
    }

    public function destroy($id)
    {
        $stok = StokBarang::findOrFail($id);
        $stok->delete();

        return redirect()->route('admin.stok.index')->with('success', 'Stok berhasil dihapus.');
    }
}
