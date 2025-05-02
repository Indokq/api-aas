@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <h3>Dashboard</h3>
    <div class="card mt-4">
        <div class="card-header bg-dark text-white">
            Statistik Jumlah Stok Barang
        </div>
        <div class="card-body">
            <canvas id="stokChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Tambah script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('stokChart').getContext('2d');
    const stokChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Stok',
                data: {!! json_encode($jumlahs) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>
@endsection
