<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
            font-family: 'Arial', sans-serif;
        }
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            transition: all 0.3s ease;
        }
        .sidebar h4 {
            text-align: center;
            color: #ffffff;
            font-weight: bold;
        }
        .sidebar a {
            color: #adb5bd;
            padding: 12px 15px;
            display: block;
            text-decoration: none;
            font-size: 18px;
            border-bottom: 1px solid #495057;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #ffffff;
        }
        .sidebar a.active {
            background-color: #007bff;
            color: white;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }
        .card-header {
            background-color: #343a40;
            color: white;
        }
        .navbar {
            z-index: 1;
        }
        .dropdown-item:hover {
            background-color: #f1f1f1;
        }
        .navbar-nav img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user-circle me-2"></i> <!-- Profile Image -->
                            Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Dashboard</h4>
        <ul class="list-unstyled">
            <li><a href="#" class="active"><i class="fa fa-cogs"></i> Kategori</a></li>
            <li><a href="#"><i class="fa fa-cube"></i> Barang</a></li>
            <li><a href="#"><i class="fa fa-archive"></i> Peminjaman</a></li>
            <li><a href="#"><i class="fa fa-exchange"></i> Pengembalian</a></li>
            <li><a href="#"><i class="fa fa-bar-chart"></i> Laporan Peminjaman</a></li>
            <li><a href="#"><i class="fa fa-bar-chart-o"></i> Laporan Pengembalian</a></li>
        </ul>
    </div>

    <!-- Bootstrap 5 JS Bundle (untuk fitur seperti dropdown atau modal) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
