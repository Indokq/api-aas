@extends('layouts.app')

@section('title', 'Data Stok')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Data Stok Barang</span>
            <a href="{{ route('admin.stok.create') }}" class="btn btn-primary">+ Tambah Stok</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stoks as $stok)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $stok->barang->nama_barang ?? '-' }}</td>
                            <td>{{ $stok->jumlah }}</td>
                            <td>
                                <a href="{{ route('admin.stok.edit', $stok->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('stok.destroy', $stok->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus stok ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Tidak ada data stok.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
