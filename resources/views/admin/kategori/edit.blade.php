@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Kategori</h1>

        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
