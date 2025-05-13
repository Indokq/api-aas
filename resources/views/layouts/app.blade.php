<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyAdmin')</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #1f2d3d;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link {
            color: #cfd8dc;
            padding: 12px 20px;
            font-size: 16px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #ffffff;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .sidebar.collapsed {
            width: 0;
            overflow: hidden;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .topbar {
            height: 56px;
            background-color: #212529;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .topbar .menu-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                z-index: 1000;
                height: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- Topbar -->
    <div class="topbar d-flex justify-content-between align-items-center px-3 py-2 bg-dark text-white">
        <button class="menu-toggle btn text-white" id="toggleSidebar">
            <i class="fa fa-bars"></i>
        </button>
    
        <div class="dropdown">
            <button class="btn text-white dropdown-toggle d-flex align-items-center gap-2" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user-circle fa-lg"></i>
                <span>Admin</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fa fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- Main Wrapper -->
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar bg-dark text-white" id="sidebar">
            <div class="p-3">
                <h5 class="text-white">
                    <a href="{{ route('dashboard') }}" class="nav-item text-white" style="text-decoration: none;">
                        Dashboard
                    </a>
                </h5>
                <ul class="nav flex-column mt-4">
                    <li class="nav-item"><a href="{{ route('admin.kategori.index') }}" class="nav-link"><i class="fa fa-cogs"></i>Kategori</a></li>
                    <li class="nav-item"><a href="{{ route('admin.barang.index') }}" class="nav-link"><i class="fa fa-cube"></i>Barang</a></li>
                    <li class="nav-item"><a href="{{ route('admin.stok.index') }}" class="nav-link"><i class="fa fa-bar-chart-o"></i>Stok</a></li>
                    <li class="nav-item"><a href="{{ route('admin.peminjaman.index') }}" class="nav-link"><i class="fa fa-archive"></i>Peminjaman</a></li>
                    <li class="nav-item"><a href="{{ route('admin.pengembalian.index') }}" class="nav-link"><i class="fa fa-exchange"></i>Pengembalian</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-bar-chart"></i>Laporan Peminjaman</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-bar-chart-o"></i>Laporan Pengembalian</a></li>
                </ul>
            </div>
        </div>

        <!-- Page Content -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        });
    </script>
</body>
</html>
