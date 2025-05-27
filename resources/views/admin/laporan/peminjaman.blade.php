@extends('layouts.app')

@section('title', 'Laporan Peminjaman')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Laporan Peminjaman</h5>
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
                                        <th>Jumlah</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Alasan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($peminjamans as $index => $peminjaman)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $peminjaman->nama_peminjam }}</td>
                                            <td>{{ $peminjaman->barang->nama_barang ?? 'N/A' }}</td>
                                            <td>{{ $peminjaman->jumlah }}</td>
                                            <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d/m/Y') }}</td>
                                            <td>{{ $peminjaman->alasan_meminjam }}</td>
                                            <td>
                                                @if($peminjaman->status == 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($peminjaman->status == 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @elseif($peminjaman->status == 'returned')
                                                    <span class="badge bg-secondary">Returned</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data peminjaman.</td>
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

            .topbar,
            .sidebar,
            .card-header,
            .footer {
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