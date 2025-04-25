@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Kategori</h1>
    <a href="#" class="btn btn-primary mb-3">Tambah Kategori</a>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data kategori -->
                    <tr>
                        <td>1</td>
                        <td>Elektronik</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Furniture</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
