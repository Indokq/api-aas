@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Kategori
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">
                                    <i class="fas fa-tag me-1"></i>Nama Kategori
                                </label>
                                <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror"
                                    id="nama_kategori" value="{{ old('nama_kategori') }}" required>
                                @error('nama_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
