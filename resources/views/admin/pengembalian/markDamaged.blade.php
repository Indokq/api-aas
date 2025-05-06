@extends('layouts.app')

@section('title', 'Tentukan Denda')

@section('content')
<div class="container mt-5">
    <h3>Masukkan Denda untuk Pengembalian Barang Rusak</h3>

    <form action="{{ route('pengembalian.update_damaged', $pengembalian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="denda">Denda</label>
            <input type="number" name="denda" id="denda" class="form-control" value="{{ old('denda') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Denda</button>
    </form>
</div>
@endsection
