@extends('layouts.app')

@section('title', 'Edit Stok')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-edit me-2"></i>Edit Stok
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

                        <form action="{{ route('stok.update', $stok->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="barang_id" class="form-label">
                                    <i class="fas fa-box me-1"></i>Nama Barang
                                </label>
                                <select name="barang_id" id="barang_id"
                                    class="form-select @error('barang_id') is-invalid @enderror" required>
                                    @foreach($barangs as $barang)
                                        <option value="{{ $barang->id }}" {{ old('barang_id', $stok->barang_id) == $barang->id ? 'selected' : '' }}>
                                            {{ $barang->nama_barang }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jumlah" class="form-label">
                                    <i class="fas fa-sort-numeric-up me-1"></i>Jumlah Stok
                                </label>
                                <input type="number" name="jumlah" id="jumlah"
                                    class="form-control @error('jumlah') is-invalid @enderror"
                                    value="{{ old('jumlah', $stok->jumlah) }}" required>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('admin.stok.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i>Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection