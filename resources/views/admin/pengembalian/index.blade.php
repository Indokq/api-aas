@extends('layouts.app')

@section('title', 'Data Pengembalian')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Data Pengembalian</span>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Peminjaman ID</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status Pengembalian</th>
                        <th>Jumlah Dikembalikan</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengembalians as $pengembalian)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengembalian->peminjaman_id }}</td>
                            <td>{{ $pengembalian->tanggal_pengembalian }}</td>
                            <td>
                                @if($pengembalian->status_pengembalian == 'pending')
                                    <span class="badge badge-warning text-dark">Pending</span>
                                @elseif($pengembalian->status_pengembalian == 'completed')
                                    <span class="badge badge-success text-dark">Completed</span>
                                @elseif($pengembalian->status_pengembalian == 'damaged')
                                    <span class="badge badge-danger text-dark">Damaged</span>
                                @endif
                            </td>
                            <td>{{ $pengembalian->jumlah_dikembalikan }}</td>
                            <td>Rp. {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
                            <td>
                                <!-- Form for Approve and Reject -->
                                @if($pengembalian->status_pengembalian == 'pending')
                                    <form action="{{ route('pengembalian.approve', $pengembalian->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>

                                    <form action="{{ route('pengembalian.reject', $pengembalian->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                @elseif($pengembalian->status_pengembalian == 'completed')
                                    <a href="{{ route('admin.pengembalian.show', $pengembalian->id) }}" class="btn btn-info btn-sm">View</a>
                                @elseif($pengembalian->status_pengembalian == 'damaged')
                                    <a href="{{ route('admin.pengembalian.mark_damaged', $pengembalian->id) }}" class="btn btn-warning btn-sm">View</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7">Tidak ada data pengembalian.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
