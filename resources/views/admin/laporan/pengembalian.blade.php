@extends('layouts.app')

@section('title', 'Laporan Pengembalian')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Laporan Pengembalian (Completed)</h5>
                    <div>
                        <button class="btn btn-sm btn-outline-primary" onclick="window.print()">
                            <i class="fas fa-print me-1"></i> Print
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Peminjam</th>
                                    <th>Barang</th>
                                    <th>Jumlah Dikembalikan</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengembalians as $index => $pengembalian)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pengembalian->peminjaman->nama_peminjam ?? 'N/A' }}</td>
                                    <td>{{ $pengembalian->peminjaman->barang->nama_barang ?? 'N/A' }}</td>
                                    <td>{{ $pengembalian->jumlah_dikembalikan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('d/m/Y') }}</td>
                                    <td>{{ $pengembalian->keterangan ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-success">Completed</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data pengembalian yang selesai.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
    @media print {
        .topbar, .sidebar, .card-header, .footer {
            display: none !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        .card-body {
            padding: 0 !important;
        }
        body {
            padding: 0;
            margin: 0;
        }
        .container-fluid {
            width: 100%;
            padding: 0;
        }
        table {
            width: 100%;
        }
    }
</style>
@endsection
