@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <h3>Dashboard</h3>

    <!-- Cards ringkasan -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Barang</h5>
                    <p class="card-text fs-4">{{ $totalBarang }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Dipinjam</h5>
                    <p class="card-text fs-4">{{ $totalDipinjam }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Pengembalian</h5>
                    <p class="card-text fs-4">{{ $totalPengembalian }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart batang -->
    <div class="card mt-3">
        <div class="card-header bg-dark text-white">
            Statistik Jumlah Stok Barang
        </div>
        <div class="card-body" style="height: 300px;">
            <canvas id="stokChart"></canvas>
        </div>
    </div>

    <!-- Pie chart -->
    <div class="card mt-3">
        <div class="card-header bg-secondary text-white">
            Perbandingan Barang, Dipinjam & Pengembalian
        </div>
        <div class="card-body" style="height: 300px;">
            <canvas id="pieChart"></canvas>
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

    // Bar Chart
    const ctx = document.getElementById('stokChart').getContext('2d');
    const stokChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Stok',
                data: jumlahs,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

    // Pie Chart
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Total Barang', 'Total Dipinjam', 'Total Pengembalian'],
            datasets: [{
                data: [totalBarang, totalDipinjam, totalPengembalian],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection
