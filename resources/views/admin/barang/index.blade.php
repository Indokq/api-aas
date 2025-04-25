@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Data Barang</h1>
    <a href="{{ route('admin.barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangs as $barang)
            <tr>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->kategori->nama_kategori }}</td>
                <td>{{ $barang->deskripsi }}</td>
                <td>{{ $barang->jumlah }}</td>
                <td>
                    <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus barang ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
