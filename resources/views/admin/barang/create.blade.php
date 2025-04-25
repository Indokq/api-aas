@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Barang</h1>

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control" required>
                <option disabled selected>Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.barang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
