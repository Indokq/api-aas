@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0 border-start border-4 border-primary ps-3 py-2">Data</h3>
            <div class="text-muted small">{{ date('l, d F Y') }}</div>
        </div>

        <!-- Cards ringkasan -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card border-0 bg-gradient shadow-sm h-100 rounded-3 overflow-hidden">
                    <div class="card-body position-relative p-0">
                        <div class="p-3 pb-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="card-title text-primary mb-0 fw-bold">Total Barang</h5>
                                <div class="icon-bg rounded-circle bg-primary bg-opacity-10 p-2">
                                    <i class="fas fa-box text-primary"></i>
                                </div>
                            </div>
                            <h2 class="mt-2 mb-3 fw-bold">{{ $totalBarang }}</h2>
                        </div>
                        <div class="progress rounded-0" style="height: 5px;">
                            <div class="progress-bar bg-primary" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-gradient shadow-sm h-100 rounded-3 overflow-hidden">
                    <div class="card-body position-relative p-0">
                        <div class="p-3 pb-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="card-title text-success mb-0 fw-bold">Total Dipinjam</h5>
                                <div class="icon-bg rounded-circle bg-success bg-opacity-10 p-2">
                                    <i class="fas fa-clipboard-list text-success"></i>
                                </div>
                            </div>
                            <h2 class="mt-2 mb-3 fw-bold">{{ $totalDipinjam }}</h2>
                        </div>
                        <div class="progress rounded-0" style="height: 5px;">
                            <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-gradient shadow-sm h-100 rounded-3 overflow-hidden">
                    <div class="card-body position-relative p-0">
                        <div class="p-3 pb-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="card-title text-warning mb-0 fw-bold">Total Pengembalian</h5>
                                <div class="icon-bg rounded-circle bg-warning bg-opacity-10 p-2">
                                    <i class="fas fa-truck text-warning"></i>
                                </div>
                            </div>
                            <h2 class="mt-2 mb-3 fw-bold">{{ $totalPengembalian }}</h2>
                        </div>
                        <div class="progress rounded-0" style="height: 5px;">
                            <div class="progress-bar bg-warning" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Chart batang -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-header bg-transparent border-0 pt-4 pb-2">
                        <h5 class="mb-0 fw-bold">Statistik Jumlah Stok Barang</h5>
                        <p class="text-muted small mb-0">Distribusi stok per kategori barang</p>
                    </div>
                    <div class="card-body">
                        <div style="height: 300px;">
                            <canvas id="stokChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie chart -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-header bg-transparent border-0 pt-4 pb-2">
                        <h5 class="mb-0 fw-bold">Perbandingan Status</h5>
                        <p class="text-muted small mb-0">Barang, Dipinjam & Pengembalian</p>
                    </div>
                    <div class="card-body">
                        <div style="height: 280px;" class="d-flex align-items-center justify-content-center">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = {!! json_encode($labels) !!};
        const jumlahs = {!! json_encode($jumlahs) !!};
        const totalBarang = {{ $totalBarang }};
        const totalDipinjam = {{ $totalDipinjam }};
        const totalPengembalian = {{ $totalPengembalian }};

        // Generate gradient for bar chart
        const ctx = document.getElementById('stokChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(54, 162, 235, 0.8)');
        gradient.addColorStop(1, 'rgba(54, 162, 235, 0.2)');

        // Bar Chart with improved styling
        const stokChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Stok',
                    data: jumlahs,
                    backgroundColor: gradient,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 6,
                    barThickness: 30,
                    maxBarThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        padding: 10,
                        cornerRadius: 6,
                        titleFont: {
                            size: 14
                        },
                        bodyFont: {
                            size: 14
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            color: '#6c757d'
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#6c757d'
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Pie Chart with improved styling
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Total Barang', 'Total Dipinjam', 'Total Pengembalian'],
                datasets: [{
                    data: [totalBarang, totalDipinjam, totalPengembalian],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(255, 206, 86, 0.8)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 2,
                    cutout: '65%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        padding: 10,
                        cornerRadius: 6
                    }
                }
            }
        });
    </script>
@endsection
