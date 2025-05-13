@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Data Peminjaman</span>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Peminjam</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjaman as $pinjam)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pinjam->nama_peminjam }}</td>
                            <td>{{ $pinjam->barang->nama_barang ?? '-' }}</td>
                            <td>{{ $pinjam->jumlah }}</td>
                            <td>{{ $pinjam->alasan_meminjam }}</td>
                            <td>
                                @if($pinjam->status == 'pending')
                                <span class="badge badge-warning text-dark">Pending</span>
                            @elseif($pinjam->status == 'approved')
                                <span class="badge badge-success text-dark">Approved</span>
                            @elseif($pinjam->status == 'rejected')
                                <span class="badge badge-danger text-dark">Rejected</span>
                            @elseif($pinjam->status == 'returned')
                                <span class="badge badge-secondary text-dark">Returned</span>
                            @endif
                            
                            </td>
                            <td>
                                @if($pinjam->status == 'pending')
                                    <form action="{{ route('peminjaman.approve', $pinjam->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    <form action="{{ route('peminjaman.reject', $pinjam->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7">Tidak ada data peminjaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
