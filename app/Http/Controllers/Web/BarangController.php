<?php

namespace App\Http\Controllers\Web;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return view('admin.barang.index', compact('barangs'));
    }

    // Form tambah barang
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.barang.create', compact('kategoris'));
    }

    // Simpan barang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'id_kategori' => 'required|exists:kategoris,id',
            'deskripsi' => 'nullable|string',
        ]);

        Barang::create($request->all());

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    // Form edit barang
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.barang.edit', compact('barang', 'kategoris'));
    }

    // Update barang
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'id_kategori' => 'required|exists:kategoris,id',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|integer'
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    // Hapus barang
    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
