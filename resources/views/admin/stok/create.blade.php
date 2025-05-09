@extends('layouts.app')

@section('title', 'Tambah Stok')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">Tambah Stok</div>
        <div class="card-body">
            <form action="{{ route('stok.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="id_barang" class="form-label">Nama Barang</label>
                    <select name="id_barang" id="id_barang" class="form-select" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Stok</label>
                    <input type="number" class="form-control" name="jumlah" id="jumlah" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.stok.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
